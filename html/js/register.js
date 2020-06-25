var navapp = new Vue({ el: '#navapp' })

var registerapp = new Vue({
    delimiters: ['${', '}'],
    el: '#registerapp',
    data() {
        return {
            form: {
                name: '',
                account:'',
                password:'',
                email: ''
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
            this.form.name = ''
            this.form.account = ''
            this.form.password = ''
            this.form.email = ''
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