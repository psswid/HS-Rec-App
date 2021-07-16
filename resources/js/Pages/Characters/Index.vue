<template>
    <div>

        <div class="w-2/3 mx-auto">
            <h1 class="mb-8 font-bold text-3xl">Characters</h1>
            <div class="mb-6 flex justify-between items-center">
                <search-filter v-model="form.search" class="w-full max-w-md mr-4" @reset="reset">
                    <label class="block text-gray-700">Gender:</label>
                    <select v-model="form.gender" class="mt-1 w-full form-select">
                        <option :value="null" />
                        <option v-for="gender in genders" :key="gender" :value="gender"> {{gender}} </option>
                    </select>
                    <input v-model="form.name" type="text" class="relative w-full px-6 py-3 rounded-r focus:ring" autocomplete="off" name="search" placeholder="Search…">
                </search-filter>
            </div>
            <div class="bg-white shadow-md rounded my-6">

                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 ">ID</th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 ">Name</th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 ">Birth year</th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 ">Homeworld</th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 ">Gender</th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 ">Titles</th>
                            <th class="px-6 py-3 border-b-2 border-gray-300"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr v-for="character in characters.data" :key="character.id">
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                <div class="flex items-center">
                                    <div>
                                        <div class="text-sm leading-5 text-gray-800">{{character.id}}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                <div class="text-sm leading-5 text-blue-900">{{character.name}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">{{character.birth_year}}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">{{character.homeworld}}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">{{character.gender}}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">
                                <ul class="divide-y divide-gray-300">
                                    <li class="p-0 hover:bg-gray-50 cursor-pointer" v-for="film in character.films" :key="film">{{film}}</li>
                                </ul>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                                <inertia-link class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none" :href="route('edit-character', character.id)">
                                Details and edit
                                </inertia-link>
                            </td>
                        </tr>
                        <tr v-if="characters.data.length === 0">
                            <td class="border-t px-6 py-4" colspan="4">No characters found.</td>
                        </tr>

                    </tbody>
                </table>
                <div class="px-5 py-5 bg-white border-t flex flex-col items-center xs:justify-between">
                    <pagination class="mt-6 self-center" :links="characters.meta.links" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Icon from '@/Components/Icon'
    import pickBy from 'lodash/pickBy'
    import Layout from '@/Layouts/Authenticated'
    import throttle from 'lodash/throttle'
    import mapValues from 'lodash/mapValues'
    import Pagination from '@/Components/Pagination'
    import SearchFilter from '@/Components/SearchFilter'

    export default {
      metaInfo: { title: 'Characters' },
      components: {
        Icon,
        Pagination,
        SearchFilter,
      },
      layout: Layout,
      props: {
        genders: Object,
        filters: Object,
        characters: Object,
      },
      data() {
        return {
          form: {
            name: this.filters.name,
            gender: this.filters.gender,
          },
        }
      },
      watch: {
        form: {
          deep: true,
          handler: throttle(function() {
            this.$inertia.get(this.route('get-characters'), pickBy(this.form), { preserveState: true })
          }, 150),
        },
      },
      methods: {
        reset() {
          this.form = mapValues(this.form, () => null)
        },
      },
    }
</script>
