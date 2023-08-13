<div id="guest-list-app">

    <div id="app">

        <div class="alert alert-danger" role="alert" v-if="errorInEmail" >
            {{ errorInEmail }}
        </div>
        <div class="row justify-content-md-center" v-if="showEdit && companies.length">
            <h6>Edit Employee email</h6>
            <div>
                <div class="form-group mb-2 col-3">
                    <input id="email" class="form-control" type="email" name="email" v-model="showEdit.email_address" required>
                </div>
                <input class="btn btn-success /m-1" type="submit" name="save" value="Save" @click="saveEmployee">
                <a class="btn btn-warning / m-1" @click="resetEmployee">Cancel</a>
            </div>
        </div>


        <table class="table table-stripe" v-if="companies.length">
            <thead>
                <th>Company name</th>
                <th>Average salary</th>
                <th>Name</th>
                <th>Email address</th>
                <th>Salary</th>
                <th></th>
            </thead>
            <tbody>
            <template v-for="data,key in companies">
                <tr v-for="employee, emKey in data.employees">

                    <td v-if="emKey==0" :rowspan="data.count">{{ data.company_name }}</td>
                    <td v-if="emKey==0" :rowspan="data.count">${{ data.average_salary }}</td>
                    <td>{{ employee.employee }}</td>
                    <td>{{ employee.email_address }}</td>
                    <td>${{ employee.salary }}</td>
                    <td>
                        <button class="btn btn-warning" @click="editEmployee(employee)">Edit</button>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>
    </div>
</div>
