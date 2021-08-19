<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gestión de Tareas
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                    <!--
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert" v-if="$page.flash.message">
                      <div class="flex">
                        <div>
                          <p class="text-sm">{{ $page.flash.message }}</p>
                        </div>
                      </div>
                    </div>
                    -->
                    <div class="flex">
                        <div class="flex-1">
                        </div>
                        <div class="flex-none">
                            <input type="text" placeholder="Nueva Tarea..." class="bg-white-500 hover:bg-white-700 font-bold py-2 px-4 rounded my-3" v-model="form.nombre">&nbsp;
                            <input type="checkbox" id="php" value="1" v-model="form.php" class="bg-white-500 hover:bg-white-700 font-bold py-2 px-4 rounded my-3"><label class="text-blue font-bold py-2 px-4 rounded my-3">PHP</label>
                            <input type="checkbox" id="javascript" value="2" class="bg-white-500 hover:bg-white-700 font-bold py-2 px-4 rounded my-3" v-model="form.javascript"><label class="text-blue font-bold py-2 px-4 rounded my-3">Javascript</label>
                            <input type="checkbox" id="css" value="3" class="bg-white-500 hover:bg-white-700 font-bold py-2 px-4 rounded my-3" v-model="form.css"><label class="text-blue font-bold py-2 px-4 rounded my-3">CSS</label>
                            <button @click="save(form)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Añadir</button>
                        </div>
                        <div class="flex-1">
                        </div>
                    </div>
                    
                     <!--{{ data }}-->
                    <table class="table-fixed w-full">
                        <thead>
                            <tr class="bg-gray-100">                        
                                <th class="px-4 py-2">Nombre</th>
                                <th class="px-4 py-2">Categorias</th>
                                <th class="px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>                    
                            <tr v-for="(item, index) in data" :key="index">
                                <td class="border px-4 py-2">{{ item.nombre_tarea }}</td>
                                <td class="border px-4 py-2">
                                    <template v-for="(categoria, index2) in item.categorias" :key="index2">
                                        {{ categoria }},
                                    </template>
                                    
                                </td>                                
                                <td class="border px-4 py-2">                                    
                                    <button @click="deleteRow(item)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                                </td>
                            </tr>                                            
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
    import AppLayout from './../Layouts/AppLayout'
    import Welcome from './../Jetstream/Welcome'
    export default {
        components: {
            AppLayout,
            Welcome                
        },
        props: ['data', 'errors'],
        data() {
            return {
                editMode: false,
                isOpen: false,
                form: {
                    nombre: null,
                    php: null,
                    javascript:null,
                    css:null,
                },
            }
        },
        methods: {
            reset: function () {
                this.form = {
                    nombre: null,
                    php: null,
                    javascript:null,
                    css:null,
                }
            },
            save: function (data) {
                this.$inertia.post('/tareas', data)
                this.reset();
            },
            deleteRow: function (data) {
                if (!confirm('Seguro que quieres eliminar esta tarea?')) return;
                data._method = 'DELETE';
                this.$inertia.post('/tareas/' + data.id, data)
                this.reset();
                
            }
        }
    }
</script>