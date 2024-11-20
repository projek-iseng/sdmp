<template>
    <div :class="{ 'content-with-sidebar': isSidebarOpen, 'content-full': !isSidebarOpen }">
        <div class="container">
            <p>Konten utama di sini.</p>
            <div class="grid">
                <div class="col card-lengkung">
                    <div class="text-center p-3 border-round-sm bg-primary font-bold">1</div>
                </div>
                <div class="col">
                    <div class="text-center p-3 border-round-sm bg-primary font-bold">2</div>
                </div>
                <div class="col">
                    <div class="text-center p-3 border-round-sm bg-primary font-bold">3</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';

defineProps(['isSidebarOpen']);
</script>

<style>
.content-full {
    margin-left: 0;
    /* Kembali ke ukuran penuh */
    transition: margin-left 0.3s ease;
}

.content-with-sidebar {
    margin-left: 15%;
    /* Posisikan konten ketika sidebar terbuka */
    transition: margin-left 0.3s ease;
}

.container {
    padding: 10px;
}

.card-lengkung {
    border: 2px solid #007bff;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    padding: 10px;
}
</style>