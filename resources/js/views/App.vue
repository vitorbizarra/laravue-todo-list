<template>
    <div>
        
        <nav>
            <div class="nav-wrapper">
                <a href="#" class="brand-logo center">Logo</a>
                <ul id="nav-mobile" class="left hide-on-med-and-down">
                    <li><router-link :to="{ name: 'home' }">Home</router-link></li>
                    <li><router-link :to="{ name: 'hello' }">Hello</router-link></li>
                    <li><router-link :to="{ name: 'example' }">Example</router-link></li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="card">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "App"
}
</script>