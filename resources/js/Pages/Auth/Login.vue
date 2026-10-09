<script setup>
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({ email: '', password: '', remember: false });
const submit = () => form.post('/login');
</script>

<template>
  <Head title="Masuk" />
  <main class="flex min-h-screen items-center justify-center bg-slate-100 px-4 py-12">
    <section class="w-full max-w-md rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
      <p class="text-sm font-semibold uppercase tracking-wide text-indigo-700">UIN Palopo</p>
      <h1 class="mt-3 text-2xl font-bold text-slate-900">Masuk ke aplikasi</h1>
      <p class="mt-2 text-sm text-slate-600">Aplikasi Pengelolaan Beasiswa</p>
      <form class="mt-8 space-y-5" @submit.prevent="submit">
        <div>
          <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email</label>
          <input id="email" v-model="form.email" type="email" autocomplete="username" required class="w-full rounded-lg border border-slate-300 px-3 py-2 outline-none focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100">
          <p v-if="form.errors.email" class="mt-1 text-sm text-red-600">{{ form.errors.email }}</p>
        </div>
        <div>
          <label for="password" class="mb-1 block text-sm font-medium text-slate-700">Kata sandi</label>
          <input id="password" v-model="form.password" type="password" autocomplete="current-password" required class="w-full rounded-lg border border-slate-300 px-3 py-2 outline-none focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100">
        </div>
        <label class="flex items-center gap-2 text-sm text-slate-600"><input v-model="form.remember" type="checkbox" class="rounded border-slate-300"> Ingat saya</label>
        <button :disabled="form.processing" class="w-full rounded-lg bg-indigo-700 px-4 py-2.5 font-semibold text-white hover:bg-indigo-800 disabled:opacity-50">
          {{ form.processing ? 'Memproses…' : 'Masuk' }}
        </button>
      </form>
    </section>
  </main>
</template>
