<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">My Tasks</div>
                    <div class="card-body">
                      <div class="input-group mb-3">
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Input task here..."
                          v-model="task.name"
                          @keydown.enter="create">
                        <div class="input-group-append">
                          <button class="btn btn-outline-success" type="button" @click="create">Add</button>
                        </div>
                      </div>
                      <div class="tasks-list">
                        <ul class="list-unstyled">
                          <li v-for="task in tasks" :key="task.id" :class="{done: task.completed}">
                            <div class="custom-control custom-checkbox">
                              <label><input type="checkbox" v-model="task.completed" @click="done(task)"> {{ task.name }}</label>
                              <div class="pull-right">
                                <a href="#" @click.prevent="remove(task)"><i class="fa fa-remove"></i></a>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <div class="alert alert-info" v-if="!tasks.length">
                          You have no tasks
                        </div>
                      </div>
                    </div>
                    <div class="card-footer" v-if="tasks.length">
                      <span class="badge badge-info">You have {{ tasks.length }} tasks</span>
                      <span class="badge badge-warning">{{ remainingTasks() }} tasks left</span>
                      <span class="badge badge-success">{{ completedTasks() }} tasks completed</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.fetchData()
        },
        data(){
          return{
            tasks: [],
            task:{
              name: ''
            }
          }
        },
        methods:{
          remainingTasks(){
            return this.tasks.filter(task => {return !task.completed}).length
          },
          completedTasks(){
            return this.tasks.filter(task => {return task.completed}).length
          },
          fetchData(){
            axios.get('/api/tasks')
                 .then((res) => {
                   this.tasks = res.data
                 })
                 .catch((err) => {
                   console.log(err)
                 })
          },
          create(){
            axios.post('/api/tasks', this.task)
                 .then((res) => {
                   this.tasks.unshift(res.data)
                   this.task.name = ''
                 })
                 .catch((err) => {
                   console.log(err);
                 })
          },
          done(task){
            axios.put(`/api/tasks/${task.id}`, {
              completed: !task.completed
            })
            .then((res) =>{
              console.log('task updated')
            })
            .catch((err) =>{
              console.log(err);
            })
          },
          remove(task){
            axios.delete(`/api/tasks/${task.id}`)
            .then((res) =>{
              const taskIndex = this.tasks.indexOf(task)
              this.tasks.splice(taskIndex, 1)
            })
            .catch((err) =>{
              console.log(err);
            })
          }
        }
    }
</script>
<style media="screen">
  body, .tasks-list {
    padding-top: 20px
  }
  .done label{
    text-decoration: line-through;
  }
</style>
