<template>
    <div class="main-wrapper">
        <div class="sidebar">
            <div class="logo">Covid-22</div>
            <div class="search">
                <input type="text" placeholder="Search Barangay">
            </div>
            <ul class="list-items">
                <li><a href="">Camaman-an</a></li>
                <li><a href="">Nazareth</a></li>
                <li><a href="">Carmen</a></li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
  name: 'Home',
}
</script>

<style scoped>
    .main-wrapper {
        /* background: red; */
        width: 100%;
        height: 100vh;
        display: flex;
    }

    .sidebar {
        background: #FFF;
        width: 250px;
        border-right: solid 1px black;
        box-shadow: 20px -2px 20px -2px #8886;
        position: relative;
        z-index: 10;
    }

    .logo {
        padding: 10px;
        text-align: center;
    }

    .search {
        border-top: 1px solid black;
        border-bottom: 1px solid black;
        padding: 15px;
    }

    .search > input{
        display: block;
        margin: 0 auto;
        padding: 7px 5px;
        width: 90%;
    }

    .sidebar > .list-items {
        padding: 0px;
        margin: 0px;
    }

    .sidebar > .list-items > li > a{
        color: #000;
        padding: 10px;
        display: block;
        text-decoration: none;
    }

    .sidebar > .list-items > li > a:hover{
        background: #e0e0e0;
    }
</style>