<?php

namespace App\Console\Commands;

use App\Repositories\CharacterRepository;
use App\Repositories\FilmRepository;
use App\Repositories\PlanetRepository;
use App\Repositories\TypeRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class GetSWApiCharacters extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swapi:get-characters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull 50 characters from swapi.dev';

    /** @var  CharacterRepository */
    private $characterRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        CharacterRepository $characterRepo,
        PlanetRepository $planetRepo,
        FilmRepository $filmRepo,
        TypeRepository $typeRepo,
    )
    {
        parent::__construct();
        $this->characterRepository = $characterRepo;
        $this->planetRepository = $planetRepo;
        $this->filmRepository = $filmRepo;
        $this->typeRepository = $typeRepo;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->line('Initiating...');

        $this->line('Checking if server is online and responding.');

        if (Http::get(config('app.api_urls.sw_api.base'))->status() !== Response::HTTP_OK) {
            throw new \Exception('Something went wrong with server. Aborting operation.');
        }

        $allCharactersEndpointResults = Http::get(config('app.api_urls.sw_api.people.base'))->json()['results'];
        $pagesToGet = 50 / count($allCharactersEndpointResults);
        collect($allCharactersEndpointResults)->each(function($contentItem) {

            $content = $this->getIdsFromUrls($contentItem);

            $this->createCharacterFromSWApi($content);

        });

        for ($i = 1; $i < $pagesToGet; $i++) {
            collect(Http::get(Http::get(config('app.api_urls.sw_api.people.page') . $i)->json()['next'])->json()['results'])->each(function($contentItem) {

                $content = $this->getIdsFromUrls($contentItem);

                $this->createCharacterFromSWApi($content);

            });
        }

        //pomijam starship i vehicles, taki sam pivot i many to many jak filmy i gatunki
        $this->line('Import finished. May the force be with you.');
    }

    /**
     * Parse object relation urls to collection of IDs of objects to pull as relation objects of character
     *
     * @param array $content
     *
     * @return Collection
     */
    private function getIdsFromUrls(array $content) : Collection
    {
        return collect($content)->map(function($value) {

            if (is_array($value)) {
                $ids = collect($value)->map(function($url){
                    $path = parse_url($url)['path'];
                    $pathExploded = explode('/', $path);

                    return $pathExploded[3];
                });
                $value = $ids->toArray();
            } else if (filter_var($value, FILTER_VALIDATE_URL)){
                $path = parse_url($value)['path'];
                $pathExploded = explode('/', $path);
                $value = $pathExploded[3];
            }

            return $value;
        });
    }

    /**
     * Creates new character from SWApi parsed content with related objects and saves to database
     *
     * @param Collection $content
     *
     * @return Collection
     */
    private function createCharacterFromSWApi(Collection $content)
    {
        $character = $this->characterRepository->create([
            'remote_id' => $content['url'],
            'name' => $content['name'],
            'mass' => $content['mass'],
            'skin_color' => $content['skin_color'],
            'birth_year' => $content['birth_year'],
            'gender' => $content['gender'],
            'homeworld_id' => $content['homeworld'],
        ]);

        $this->line($character->name . ' added to Characters table.');


        $this->createRelatedObject(
            'planet',
            config('app.api_urls.sw_api.planets.base') . $content['homeworld'],
            $content['homeworld'],
            'name'
        );

        // setting related objects IDs and preventing double-setting many to many in case of using command more than once
        $character->films()->syncWithoutDetaching($content['films']);
        collect($content['films'])->each( function($filmId){
            $this->createRelatedObject(
                'film',
                config('app.api_urls.sw_api.films.base') . $filmId,
                $filmId,
                'title'
            );
        });

        $character->species()->syncWithoutDetaching($content['species']);
        collect($content['species'])->each( function($typeId){
            $this->createRelatedObject(
                'type',
                config('app.api_urls.sw_api.species.base') . $typeId,
                $typeId,
                'name'
            );
        });
    }

    /**
     * @param string $relatedObjectName
     * @param string $relatedObjectApiUrl
     * @param int $objectRemoteId
     * @param string $pulledObjectNameField
     *
     * @return void
     */
    private function createRelatedObject(string $relatedObjectName, string $relatedObjectApiUrl, int $objectRemoteId, string $pulledObjectNameField)
    {
        $classRepoName = $relatedObjectName . 'Repository';
        $content = Http::get($relatedObjectApiUrl)->json();

        $object = $this->$classRepoName->create([
            'remote_id' => $objectRemoteId,
            'name' => $content[$pulledObjectNameField]
        ]);

        $this->line($object->name . ' added to ' . ucfirst($relatedObjectName) . 's table.');
    }

}
