<template>
    <div class="card border-0 mb-4">
        <a :href="item.link">
            <img class="card-img border round" :src="item.img" alt="Card image cap">
        </a>

        <div class="card-body mt-2 text-center p-0">
            <span class="mr-3">
                <span v-for="category of item.categories" :key="category.id">
                    <a :href="category.link" class="font-weight-bold mr-1" :style="{ color: category.color }">
                        {{ category.name }}
                    </a>
                </span>
            </span>

            <small class="text-gray">
                <a class="text-nowrap text-decoration-none text-gray mr-3" :href="item.link + '#comments'">
                    <i class="far fa-comment"></i>
                    {{ item.comments_count }}
                </a>
                <span class="text-nowrap">
                    <i class="far fa-eye"></i>
                    {{ item.views }}
                </span>
            </small>
        </div>

        <h4 class="card-title mt-1">
            <a :href="item.link" class="text-dark">{{ item.title }}</a>
        </h4>
    </div>
</template>

<script>
export default {
    props: ['item']
}
</script>