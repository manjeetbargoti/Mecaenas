<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users</h3>

                <div class="card-tools">
                  <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addNewUser"><i class="fas fa-user-plus fa-fw"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Type</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>183</td>
                      <td>John Doe</td>
                      <td>11-7-2014</td>
                      <td><span class="tag tag-success">Approved</span></td>
                      <td>
                          <a class="btn btn-sm bg-primary"><i class="fa fa-edit"></i></a>
                          <a class="btn btn-sm bg-danger"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNewUser" tabindex="-1" role="dialog" aria-labelledby="addNewUserLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewUserLabel">New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="createUser">
                  <div class="modal-body">
                    <div class="form-group">
                      <input v-model="form.name" type="text" name="name" class="form-control" placeholder="Name" :class="{ 'is-invalid': form.errors.has('name') }">
                      <has-error :form="form" field="name"></has-error>
                    </div>

                    <div class="form-group">
                      <input v-model="form.email" type="email" name="email" class="form-control" placeholder="Email Address" :class="{ 'is-invalid': form.errors.has('email') }">
                      <has-error :form="form" field="email"></has-error>
                    </div>

                    <div class="form-group">
                      <input v-model="form.phone" type="phone" name="phone" class="form-control" placeholder="Phone Number" :class="{ 'is-invalid': form.errors.has('phone') }">
                      <has-error :form="form" field="phone"></has-error>
                    </div>

                    <div class="form-group">
                      <textarea v-model="form.bio" name="bio" rows="2" class="form-control" placeholder="Short bio for user (Optional)" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                      <has-error :form="form" field="bio"></has-error>
                    </div>

                    <div class="form-group">
                      <select v-model="form.type" name="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                        <option value="">Select User Role</option>
                        <option value="admin">Admin</option>
                        <option value="user">Standard User</option>
                        <option value="author">Author</option>
                      </select>
                      <has-error :form="form" field="type"></has-error>
                    </div>

                    <div class="form-group">
                      <input v-model="form.password" type="password" name="password" placeholder="Password" class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                      <has-error :form="form" field="password"></has-error>
                    </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      <button :disabled="form.busy" type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
      data(){
        return {
          form: new Form({
            name : '',
            email : '',
            phone : '',
            password : '',
            type: '',
            bio : '',
            photo : '',
          })
        }
      },
      methods : {
        createUser(){
          this.form.post('api/user');
        }
      },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
