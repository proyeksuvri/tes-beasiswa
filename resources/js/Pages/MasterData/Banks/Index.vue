<script setup>
import { Head, router, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
defineProps({ banks: { type: Array, required: true } });
const page = usePage(); const editingId = ref(null);
const form = useForm({ code: '', name: '', is_active: true });
function reset() { editingId.value = null; form.reset(); form.clearErrors(); form.is_active = true; }
function edit(item) { editingId.value = item.id; form.code = item.code; form.name = item.name; form.is_active = item.is_active; form.clearErrors(); }
function submit() { const options = { onSuccess: reset }; editingId.value ? form.put(`/master/bank/${editingId.value}`, options) : form.post('/master/bank', options); }
function remove(item) { if (confirm(`Hapus bank "${item.name}"?`)) router.delete(`/master/bank/${item.id}`); }
</script>
<template>
  <Head title="Master Bank" />
  <main class="min-h-screen bg-slate-50 p-6 text-slate-900 sm:p-10"><div class="mx-auto max-w-5xl">
    <a href="/dashboard" class="text-sm font-semibold text-indigo-700">← Dashboard</a>
    <h1 class="mt-4 text-2xl font-bold">Master Bank</h1><p class="mt-1 text-sm text-slate-600">Kelola referensi bank untuk data beasiswa.</p>
    <p v-if="page.props.flash?.success" class="mt-4 rounded-lg bg-emerald-50 p-3 text-sm text-emerald-800">{{ page.props.flash.success }}</p>
    <div class="mt-6 grid gap-6 md:grid-cols-2">
      <form @submit.prevent="submit" class="space-y-4 rounded-xl border bg-white p-5"><h2 class="font-semibold">{{ editingId ? 'Ubah bank' : 'Tambah bank' }}</h2>
        <label class="block text-sm font-medium">Kode<input v-model="form.code" required maxlength="50" class="mt-1 w-full rounded-lg border p-2.5" /><span v-if="form.errors.code" class="text-sm text-red-700">{{ form.errors.code }}</span></label>
        <label class="block text-sm font-medium">Nama bank<input v-model="form.name" required maxlength="255" class="mt-1 w-full rounded-lg border p-2.5" /><span v-if="form.errors.name" class="text-sm text-red-700">{{ form.errors.name }}</span></label>
        <label class="flex items-center gap-2 text-sm"><input v-model="form.is_active" type="checkbox" /> Aktif</label>
        <div class="flex gap-2"><button :disabled="form.processing" class="rounded-lg bg-indigo-700 px-4 py-2 text-sm font-semibold text-white">Simpan</button><button v-if="editingId" type="button" @click="reset" class="rounded-lg border px-4 py-2 text-sm">Batal</button></div>
      </form>
      <section class="overflow-hidden rounded-xl border bg-white"><div class="border-b p-5 font-semibold">Daftar bank ({{ banks.length }})</div>
        <p v-if="!banks.length" class="p-6 text-sm text-slate-500">Belum ada data bank.</p>
        <div v-for="item in banks" :key="item.id" class="flex items-center justify-between gap-3 border-b p-4 last:border-0"><div><p class="font-semibold">{{ item.name }}</p><p class="text-sm text-slate-500">{{ item.code }} · {{ item.is_active ? 'Aktif' : 'Nonaktif' }}</p></div><div class="flex gap-2"><button @click="edit(item)" class="rounded border px-3 py-1.5 text-sm">Ubah</button><button @click="remove(item)" class="rounded border border-red-200 px-3 py-1.5 text-sm text-red-700">Hapus</button></div></div>
      </section>
    </div>
  </div></main>
</template>
