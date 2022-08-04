<template>
    <main class="form-signin w-100">
        <div class=""
             v-if="status === 'ok'">
            <div class="lds-heart">
                <div></div>
            </div>
            <h2>
                Поздравляю, вы вошли в систему
            </h2>
        </div>
        <form v-else>
            <h1><span>&#xF24A;</span><span class="text-info">&#xF24A;</span><span>&#xF24A;</span></h1>

            <h1 class="h3 mb-3 fw-normal">Вход</h1>

            <div class="form-floating">
                <input type="email"
                       class="form-control"
                       id="floatingInput"
                       placeholder="Введите email"
                       v-model="mail">
                <label for="floatingInput">Aдрес электронной почты</label>
            </div>
            <div class="form-floating">
                <input type="password"
                       class="form-control"
                       id="floatingPassword"
                       placeholder="Пароль"
                       v-model="password">
                <label for="floatingPassword">Пароль</label>
            </div>

            <div class="checkbox mb-3">
            </div>
            <a class="w-100 btn btn-info"
               @click="setAutenficate()">Войти</a>

            <div style="font-size: 13px; display: flex; justify-content: space-between; padding: 10px;">
                <router-link :to="'/recover'">Забыли пароль?</router-link>
                <router-link :to="'/create'">Зарегестрироваться</router-link>
            </div>

            <p class="mt-5 mb-3 text-muted">© 2017–2021</p>
        </form>


    </main>
</template>

<script>
export default {
    name: "authentication",

    components: {},
    data() {
        return {
            password: '',
            mail: '',
            status: '',
            // message: '',
        }
    },
    methods: {

        setAutenficate() {
            let formData = new FormData();
            formData.append("password", this.password);
            formData.append("mail", this.mail);

            axios.post('http://zi.loc/authentication.php',
                formData,
                {
                    headers: {"Content-type": "application/json",},
                })
                .then((res) => {
                    console.log(res.data)
                    let type = res.data.status === 'ok' ? 'success' : 'error';
                    this.status = res.data.status;
                    toast.open({
                        message: res.data.message,
                        type: type,
                        duration: 3000
                    });
                })
        }
    },
}
</script>

<style scoped>
.lds-heart {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
    transform: rotate(45deg);
    transform-origin: 40px 40px;
}

.lds-heart div {
    top: 32px;
    left: 32px;
    position: absolute;
    width: 32px;
    height: 32px;
    background: #0dcaf0;
    animation: lds-heart 1.2s infinite cubic-bezier(0.215, 0.61, 0.355, 1);
}

.lds-heart div:after,
.lds-heart div:before {
    content: " ";
    position: absolute;
    display: block;
    width: 32px;
    height: 32px;
    background: #0dcaf0;
}

.lds-heart div:before {
    left: -24px;
    border-radius: 50% 0 0 50%;
}

.lds-heart div:after {
    top: -24px;
    border-radius: 50% 50% 0 0;
}

@keyframes lds-heart {
    0% {
        transform: scale(0.95);
    }
    5% {
        transform: scale(1.1);
    }
    39% {
        transform: scale(0.85);
    }
    45% {
        transform: scale(1);
    }
    60% {
        transform: scale(0.95);
    }
    100% {
        transform: scale(0.9);
    }
}

</style>
