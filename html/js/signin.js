var navapp = new Vue({ el: '#navapp' })

var signinapp = new Vue({
    delimiters: ['${', '}'],
    el: '#signinapp',
    data() {
        return {
            types: [
                'text',
                'password'
            ],
            form: {
                account:'',
                password:''
            },
            show: true
        }
    },
    methods: {
        onSubmit(evt) {
            evt.preventDefault()
            alert(JSON.stringify(this.form))
        },
        onReset(evt) {
            evt.preventDefault()
            // Reset our form values
            this.form.account = ''
            this.form.password = ''
            // Trick to reset/clear native browser form validation state
            this.show = false
            this.$nextTick(() => {
                this.show = true
            })
        }
    }
})

window.onload = () => {
    document.getElementsByTagName("html")[0].style.visibility = "visible";
}
