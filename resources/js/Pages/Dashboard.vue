<script setup>
import { Head, router, usePage } from '@inertiajs/vue3';
const page = usePage();
const logout = () => router.post('/logout');
</script>

<template>
  <Head title="Dashboard" />
  <main class="min-h-screen bg-slate-50 p-6 text-slate-900 sm:p-10">
    <section class="mx-auto max-w-5xl">
      <header class="flex flex-wrap items-start justify-between gap-4">
        <div>
          <p class="text-sm font-semibold uppercase tracking-wide text-indigo-700">UIN Palopo</p>
          <h1 class="mt-2 text-3xl font-bold">Dashboard Pengelolaan Beasiswa</h1>
          <p class="mt-2 text-slate-600">Fondasi akses pengguna berhasil dimuat.</p>
        </div>
        <button @click="logout" class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-semibold hover:bg-slate-100">Keluar</button>
      </header>
      <div class="mt-8 rounded-xl border border-slate-200 bg-white p-6">
        <p class="text-sm text-slate-500">Pengguna aktif</p>
        <p class="mt-1 text-lg font-semibold">{{ page.props.auth.user.name }}</p>
        <p class="mt-1 text-sm text-slate-600">{{ page.props.auth.user.email }}</p>
        <div class="mt-4 flex flex-wrap gap-2">
          <span v-for="role in page.props.auth.user.roles" :key="role" class="rounded-full bg-indigo-50 px-3 py-1 text-sm font-medium text-indigo-800">{{ role }}</span>
        </div>
      </div>
      <p class="mt-6 text-sm text-slate-500">Menu operasional akan ditambahkan setelah master data dan alur SK disepakati.</p>
    </section>
  </main>
</template>
