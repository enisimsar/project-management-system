<template>
    <div class="category-card">
        <div class="link-container">
            <span><a :href="url">{{ name }}</a></span>
        </div>
        <div class="img-container">
            <img :src="img" />
        </div>
    </div>
</template>

<script>
export default {
    props: {
        name: {
            type: String,
            required: true
        },
        img: {
            type: String,
            required: true
        },
        url: {
            type: String,
            required: true
        }
    },

    data() {
        return {};
    }
};
</script>

<style scoped>
.category-card {
    display: flex;
    width: 100%;
    height: 100%;
    flex-direction: column;
    border: 10px solid #f0f4fb;
    background: white;
}

.link-container {
    padding: 10px 10px;
    display: flex;
    justify-content: center;
    height: 20%;
}
.img-container {
    width: 100%;
    height: 80%;
    position: relative;
}

.img-container img {
    object-fit: cover;
}

.img-container::after {
    width: 0;
    height: 0;
    border-left: 20px solid transparent;
    border-right: 20px solid transparent;
    border-top: 20px solid #fff;
    content: "";
    left: 50%;
    transform: translateX(-50%);
    position: absolute;
    top: 0;
}
img {
    width: 100%;
    height: 100%;
}
a {
    font-size: 18px;
    font-weight: 700;
    color: #00cca3;
}
</style>