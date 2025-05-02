<script setup lang="ts">
import { ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head,useForm,router} from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Dashboard',
    href: '/dashboard',
  },
];
defineProps(['taskList'])
const form = useForm
({
  'task':''
})

// const inputValue = ref('');
const todos = ref<string[]>([]);


// const addTodo = () => {
//   const value = inputValue.value.trim();
//   if (value) {
//     todos.value.push(value); 
//   }
//   inputValue.value = '';
// };

const addTask =()=>{
  form.post(route('task.store'),{
    onSuccess: ()=>{
      form.reset()
    }
  })

  
}
const markTaskCompleted = (taskId:string)=>{
  router.patch(route('task.markTaskCompleted',{
    'task':taskId
  }))
}
const remove = (taskId:string)=>{
  router.delete(route('task.remove',{
  'task':taskId
  }))
}
const toggleCompleted = (taskId : string)=>{
  router.patch(route('task.toggle_completed', {
    'task':taskId
  }))
}

const editingTaskId = ref(null); // To track which task is being edited
const editedTask = ref(''); // To store the edited task value

const startEditing = (task) => {
  editingTaskId.value = task.id
  editedTask.value = task.task
}

const cancelEdit = () => {
  editingTaskId.value = null
  editedTask.value = ''
}

const saveTask = (task) => {
  router.patch(route('task.update', { task: task.id }), {
    task: editedTask.value,
    onSuccess: () => {
      editingTaskId.value = null
      editedTask.value = ''
    },
    onError: (err) => {
      console.error(err)
    }
  })
}

</script>

  


<template>
  <Head title="Task App" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <!-- <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
      <div class="p-6 rounded-xl shadow-lg max-w-md bg-white mx-auto">
  <div
      class="min-h-screen bg-cover bg-center bg-no-repeat flex items-center justify-center text-white"
      style="background-image: url('/images/task.jpg');"
    >
      <div class="text-3xl font-bold bg-black bg-opacity-50 p-4 rounded">
        Task App Background Working!
      </div>
    </div>

    

        
        <div class="flex items-center space-x-2">
          <input
            v-model="form.task"
            type="text"
            placeholder="Add a new task..."
            class="px-4 py-2 rounded-md border border-black-300 bg-green-200 text-black focus:outline-none w-full"
          />
          <button
            @click="addTask"
            :disabled="!form.task.trim()"
            class="bg-blue-600 text-white p-2 rounded-full hover:bg-grey-700 disabled:opacity-50"
          >
            +
          </button>
        </div>

        
        <ul class="mt-4 space-y-3">
          <li
            v-for="(todo, index) in todos"
            :key="index"
            class="bg-gray-100 px-4 py-2 rounded-md"
          >
            {{ todo }}
          </li>
        </ul>
      </div>
    </div> -->
    <div class="flex h-full flex-1 flex-col gap-4 bg-gray-100 border border-gray-300 rounded-xl p-4">
      <div class="mx-auto w-2/3">
        <form @submit.prevent="addTask()" class="block mb-3 space-y-2">
          <label for="task" class="text-black">Task name</label>
          <div class="flex gap-2">
              <input id="task"
              v-model.trim="form.task"
              class="px-3 py-2 border border-gray-400 rounded w-2/3 mr-2 text-black" 
              type="text" 
              placeholder="Enter task" name="task" required/>
            <button
              type="submit"
              class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
              <Plus class="w-5 h-5" />
              Add
            </button>
          </div>
        </form>

  <div v-for="(task, idx) in taskList" :key="task.id"
  class="mb-3 flex gap-3 items-center rounded border px-4 py-2 bg-gray-50 hover:bg-gray-100">
  <input type="checkbox" :checked="task.completed_at" @change="toggleCompleted(task.id)" />


  <div v-if="editingTaskId === task.id" class="flex-1">
    <input
      v-model="editedTask"
      class="border rounded px-2 py-1 w-full"
    />
  </div>


  <div v-else class="flex-1 text-black">
    {{ task.task }} at {{ new Date(task.updated_at).toLocaleString() }}
  </div>


  <div class="flex gap-2">
    <button @click="startEditing(task)" v-if="editingTaskId !== task.id" class="text-blue-600">✏️</button>
    <button @click="saveTask(task)" v-if="editingTaskId === task.id" class="text-green-600">💾</button>
    <button @click="cancelEdit" v-if="editingTaskId === task.id" class="text-gray-500">❌</button>
    <button @click="remove(task.id)" class="text-red-600">✖️</button>
  </div>


        </div>
                
      </div>
    </div>
  </AppLayout>
</template>
