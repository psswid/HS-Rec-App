<template>
  <div class="w-2/3 mx-auto">
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('get-characters')">Characters</inertia-link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.name }}
    </h1>

    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl pb-6">
      <form @submit.prevent="update">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
            <div class="grid grid-cols-1">
                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Name</label>
                <text-input @update:input="setInputData" :value="form.name" :error="form.errors.name" :target="'name'" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" label="Name" />
            </div>
            <div class="grid grid-cols-1">
                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Gender</label>
                <text-input @update:input="setInputData" :value="form.gender" :error="form.errors.gender" :target="'gender'" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" label="Gender" />
            </div>
            <div class="grid grid-cols-1">
                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Culture</label>
                <text-input @update:input="setInputData" :value="form.culture" :error="form.errors.culture" :target="'culture'" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" label="Culture" />
            </div>
            <div class="grid grid-cols-1">
                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Birth year</label>
                <text-input @update:input="setInputData" :value="form.birth_year" :error="form.errors.birth_year" :target="'birth_year'" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" label="Birth year" />
            </div>
            <div class="grid grid-cols-1">
                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Died year</label>
                <text-input @update:input="setInputData" :value="form.died_year" :error="form.errors.died_year" :target="'died_year'" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" label="Died year" />
            </div>
        </div>
        <div class="flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5">
            <button class="w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2" type="submit">Update Character</button>
        </div>
      </form>
        <div class="bg-white p-3 shadow-sm rounded-sm">
            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                <span clas="text-green-500">
                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </span>
                <span class="tracking-wide">Character details</span>
            </div>
            <div class="text-gray-700">
                <div class="grid md:grid-cols-2 text-sm">
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Name</div>
                        <div class="px-4 py-2">{{ this.character.data.name }}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Mass</div>
                        <div class="px-4 py-2">{{ this.character.data.mass }}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Skin color</div>
                        <div class="px-4 py-2">{{ this.character.data.skin_color }}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Birth year</div>
                        <div class="px-4 py-2">{{ this.character.data.birth_year }}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Died year</div>
                        <div class="px-4 py-2">{{ this.character.data.died_year }}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Gender</div>
                        <div class="px-4 py-2">{{ this.character.data.gender }}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Culture</div>
                        <div class="px-4 py-2">{{ this.character.data.culture }}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Homeworld</div>
                        <div class="px-4 py-2">{{ this.character.data.homeworld }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white p-3 shadow-sm rounded-sm">
            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                <span clas="text-green-500">
                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </span>
                <span class="tracking-wide">Character movies</span>
            </div>
            <div class="text-gray-700">
                <div class="grid grid-cols-2" :key="film" v-for="film in this.character.data.films">
                    <div class="px-4 py-2">{{ film }}</div>
                </div>
            </div>
        </div>
    </div>

  </div>
</template>

<script>
import Icon from '@/Components/Icon'
import Layout from '@/Layouts/Authenticated'
import TextInput from '@/Components/TextInput'

export default {
  metaInfo() {
    return { title: this.form.name }
  },
  components: {
    Icon,
    TextInput,
  },
  layout: Layout,
  props: {
    character: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        name: this.character.data.name,
        culture: this.character.data.culture,
        birth_year: this.character.data.birth_year,
        died_year: this.character.data.died_year,
        gender: this.character.data.gender,
      }),
    }
  },
  methods: {
    update() {
      this.form.put(this.route('update-character', this.character.data.id))
    },
    setInputData(formFieldName, inputData) {
        this.form[formFieldName] = inputData;
    },
  },
}
</script>
