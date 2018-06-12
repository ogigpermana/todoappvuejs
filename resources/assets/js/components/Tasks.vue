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
                          <li v-for="task in tasks" :key="task.id">
                            <div class="checkbox">
                              <label><input type="checkbox"> {{ task.name }}</label>
                            </div>
                          </li>
                        </ul>
                      </div>
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
          }
        }
    }
</script>
<style media="screen">
  body, .tasks-list {
    padding-top: 20px
  }
</style>
