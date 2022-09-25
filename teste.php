<style>
html,
body {
    height: 100vh;
    margin: 0
}

.box {
    display: flex;
    flex-flow: column;
    height: 100vh;
}

.content {
    flex-grow: 1;
    background-color: blue;
}

.paginacao {
    flex-grow: 0;
    background-color: red;
}
</style>

<div class="box">
    <div class="content">
        <p>content</p>
    </div>
    <div class="paginacao">
        <p>footer</p>
    </div>
</div>