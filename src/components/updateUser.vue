<template>
    <main class="form-signin w-100">
        <form>
            <h1>&#xF24A;</h1>

            <h1 class="h3 mb-3 fw-normal">Восстановление</h1>

            <div class="form-floating"
                v-if="!flagCheck">
                <input type="email"
                       class="form-control"
                       id="floatingInput"
                       placeholder="Введите email"
                       v-model="mail">
                <label for="floatingInput">Aдрес электронной почты</label>
            </div>

            <div v-if="flagCheck">
                <div class="form-floating">
                    <input type="password"
                           class="form-control"
                           id="floatingPassword1"
                           placeholder="Пароль"
                           v-model="password">
                    <label for="floatingPassword1">Новый пароль</label>
                </div>
                <div class="form-floating">
                    <input type="password"
                           class="form-control"
                           id="floatingPassword"
                           placeholder="Пароль"
                           v-model="passwordCopy">
                    <label for="floatingPassword">повторите пароль</label>
                </div>
            </div>

            <div class="checkbox mb-3">
            </div>
            <a class="w-100 btn btn-info"
               @click="check()"
                v-if="!flagCheck">Востановить</a>
            <a class="w-100 btn btn-info"
               @click="update()"
                v-if="flagCheck">Сохранить</a>

            <div style="font-size: 13px; display: flex; justify-content: space-between; padding: 10px 10px;">
                <router-link :to="'/'">Войти</router-link>
                <router-link :to="'/create'">Зарегестрироваться</router-link>
            </div>
        </form>

    </main>
</template>

<script>
export default {
    name: "updateUser",

    data(){
        return{
            password: '',
            mail: '',
            passwordCopy: '',
            flagCheck: false,
            url: 'http://zi.loc/update.php',
        }
    },

    watch:{
        flagCheck: function (val){
            this.url = val ? 'http://zi.loc/update2.php' : 'http://zi.loc/update.php';
        }
    },

    methods: {

        check(){
            let formData = new FormData();
            formData.append("mail", this.mail);

            axios.post('http://zi.loc/update.php', formData,
                {headers: {"Content-type": "application/json",},})
                .then((res)=> {
                    if(res.data.status === 'ok'){
                        this.flagCheck = true
                    }else{
                        toast.open({
                            message: res.data.message,
                            type: 'error',
                            duration: 3000
                        });
                    }
                })
        },

        update(){
            if(this.passwordCopy === this.password){
                let formData = new FormData();
                formData.append("password", this.password);
                formData.append("mail", this.mail);

                axios.post('http://zi.loc/update2.php', formData,
                    {headers: {"Content-type": "application/json",},})
                    .then((res)=> {
                        if(res.data.status === 'ok'){
                            toast.open({
                                message: res.data.message,
                                type: 'success',
                                duration: 3000
                            });
                        }else{
                            toast.open({
                                message: res.data.message,
                                type: 'error',
                                duration: 3000
                            });
                        }
                    })
            }
            else{
                toast.open({
                    message: 'Пароли не совпадают',
                    type: 'warning',
                    duration: 3000
                });
            }
        }
    }
}
</script>

<style scoped>

</style>
