/**
 * The main entry point for the employee list Read and Update operations
 */
export default {
    data() {
        return {
            count: 1,
            companies: [],
            showEdit: false,
            errorInEmail: false
        }
    },
    mounted: function () {
        this.getAllEmployees()
    },
    methods: {
        getAllEmployees: function () {
            axios.get("/employees_list").then( (Response) => {
                this.companies = Response.data
            }).catch(err => console.error(err))
        },
        editEmployee(employee)
        {
            this.errorInEmail = false
            this.showEdit = employee;
            this.scrollToTop()
        },
        scrollToTop() {
            window.scrollTo(0,0);
        },
        saveEmployee()
        {
            if (this.showEdit) {
                if(!this.checkIfValidEmail(this.showEdit.email_address)){
                    this.errorInEmail = 'Please enter a valid email';
                    return;
                }
                this.errorInEmail = false
                axios.post("/update_employee",{'id':this.showEdit.id, 'email':this.showEdit.email_address,'save':true}).then((Response)=>{

                    let data = Response.data;
                    if (data.employee && data.employee.email_address==this.showEdit.email_address){
                        this.showEdit = null;
                    }
                }).catch(err => {
                    console.error(err)
                    this.errorInEmail = 'Sorry, Something went wrong. Please try again later.';
                })
            } else {
                this.errorInEmail = false
            }
        },
        checkIfValidEmail(email)
        {
            let validRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,20}$/g;
            return email.match(validRegex)
        }
    }
}