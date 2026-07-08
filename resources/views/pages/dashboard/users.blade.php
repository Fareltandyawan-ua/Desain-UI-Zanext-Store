@extends('layouts.admin')
@section('title', 'Manage Users')
@section('breadcrumb', 'Admin / Users')
@section('page-title', 'Users')

@section('content')
    <div x-data="{ createOpen: false, editOpen: null }" class="space-y-5">
        <div class="rounded-2xl border border-border bg-card p-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-display font-bold text-lg">User List ({{ $users->count() }})</h2>
                <p class="text-sm text-muted-foreground mt-1">Add, edit, and monitor customer or admin accounts.</p>
            </div>
            <button @click="createOpen = true" class="h-10 px-4 rounded-full bg-primary text-primary-foreground text-sm font-semibold">+ New User</button>
        </div>

        <form method="GET" action="{{ route('dashboard.users') }}" class="rounded-2xl border border-border bg-card p-4 grid sm:grid-cols-[1fr_auto_auto] gap-3">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search name or email..." class="h-11 px-4 rounded-xl bg-background border border-border text-sm focus:outline-none focus:border-primary">
            <select name="role" class="h-11 px-4 rounded-xl bg-background border border-border text-sm">
                <option value="all" @selected(($role ?? 'all') === 'all')>All Roles</option>
                <option value="user" @selected(($role ?? 'all') === 'user')>User</option>
                <option value="admin" @selected(($role ?? 'all') === 'admin')>Admin</option>
            </select>
            <div class="flex gap-2">
                <button class="h-11 px-5 rounded-xl bg-primary text-primary-foreground text-sm font-semibold">Apply</button>
                @if(!empty($search) || ($role ?? 'all') !== 'all')
                    <a href="{{ route('dashboard.users') }}" class="h-11 px-5 rounded-xl border border-border bg-white/5 text-sm font-semibold flex items-center">Reset</a>
                @endif
            </div>
        </form>

        <div class="grid gap-3 lg:hidden">
            @forelse($users as $u)
                <div class="rounded-2xl border border-border bg-card p-4">
                    <div class="flex items-start gap-3">
                        <span class="size-11 rounded-full bg-primary text-primary-foreground grid place-items-center font-bold shrink-0">{{ substr($u->name, 0, 1) }}</span>
                        <div class="min-w-0 flex-1">
                            <p class="font-display font-semibold truncate">{{ $u->name }}</p>
                            <p class="text-xs text-muted-foreground truncate mt-1">{{ $u->email }}</p>
                            <div class="mt-2 flex items-center justify-between gap-3">
                                <span class="px-2 py-1 rounded-full text-[10px] uppercase tracking-widest {{ $u->role === 'admin' ? 'bg-primary/10 text-primary' : 'bg-white/5 text-muted-foreground' }}">{{ $u->role }}</span>
                                <span class="text-xs text-muted-foreground">{{ $u->created_at?->format('M d, Y') ?? '—' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end gap-3">
                        <button @click="editOpen = '{{ $u->id }}'" class="h-9 px-4 rounded-full border border-primary/50 text-primary text-xs font-semibold">Edit</button>
                        @if($u->id !== auth()->id())
                            <form method="POST" action="{{ route('dashboard.users.destroy', $u->id) }}">@csrf @method('DELETE')<button class="h-9 px-4 rounded-full border border-destructive/50 text-destructive text-xs font-semibold" onclick="return confirm('Delete this user?')">Delete</button></form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="rounded-2xl border border-border bg-card p-8 text-center text-muted-foreground">No users found.</div>
            @endforelse
        </div>

        <div class="hidden lg:block rounded-2xl border border-border bg-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[850px] text-sm">
                    <thead class="border-b border-border text-muted-foreground text-xs uppercase tracking-widest">
                        <tr><th class="text-left p-4">User</th><th class="text-left p-4">Email</th><th class="text-left p-4">Role</th><th class="text-left p-4">Joined</th><th class="text-right p-4">Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach($users as $u)
                            <tr class="border-b border-border last:border-0 hover:bg-white/[0.02]">
                                <td class="p-4 flex items-center gap-3"><span class="size-9 rounded-full bg-primary text-primary-foreground grid place-items-center font-bold">{{ substr($u->name, 0, 1) }}</span><span class="font-semibold">{{ $u->name }}</span></td>
                                <td class="p-4 text-muted-foreground">{{ $u->email }}</td>
                                <td class="p-4"><span class="px-2 py-1 rounded-full text-[10px] uppercase tracking-widest {{ $u->role === 'admin' ? 'bg-primary/10 text-primary' : 'bg-white/5 text-muted-foreground' }}">{{ $u->role }}</span></td>
                                <td class="p-4 text-muted-foreground">{{ $u->created_at?->format('M d, Y') ?? '—' }}</td>
                                <td class="p-4 text-right space-x-3">
                                    <button @click="editOpen = '{{ $u->id }}'" class="text-xs text-primary hover:underline">Edit</button>
                                    @if($u->id !== auth()->id())
                                        <form method="POST" action="{{ route('dashboard.users.destroy', $u->id) }}" class="inline">@csrf @method('DELETE')<button class="text-xs text-destructive hover:underline" onclick="return confirm('Delete this user?')">Delete</button></form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="createOpen" x-transition.opacity class="fixed inset-0 z-50 grid place-items-center p-4" style="display:none">
            <button @click="createOpen = false" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></button>
            <form method="POST" action="{{ route('dashboard.users.store') }}" class="relative w-full max-w-xl rounded-2xl border border-border bg-background p-6">
                @csrf
                <div class="flex items-center justify-between mb-5"><h3 class="font-display font-bold text-xl">New User</h3><button type="button" @click="createOpen = false">✕</button></div>
                <div class="grid gap-4">
                    <label class="block"><span class="block text-xs text-muted-foreground mb-2">Name</span><input name="name" value="{{ old('name') }}" required class="w-full h-11 px-4 rounded-xl bg-card border border-border text-sm focus:outline-none focus:border-primary"></label>
                    <label class="block"><span class="block text-xs text-muted-foreground mb-2">Email</span><input type="email" name="email" value="{{ old('email') }}" required class="w-full h-11 px-4 rounded-xl bg-card border border-border text-sm focus:outline-none focus:border-primary"></label>
                    <label class="block"><span class="block text-xs text-muted-foreground mb-2">Role</span><select name="role" required class="w-full h-11 px-4 rounded-xl bg-card border border-border text-sm focus:outline-none focus:border-primary"><option value="user">User</option><option value="admin">Admin</option></select></label>
                    <label class="block"><span class="block text-xs text-muted-foreground mb-2">Password</span><input type="password" name="password" required minlength="8" class="w-full h-11 px-4 rounded-xl bg-card border border-border text-sm focus:outline-none focus:border-primary"><span class="block mt-2 text-xs text-muted-foreground">Minimum 8 characters.</span></label>
                </div>
                <button class="mt-5 h-11 px-5 rounded-full bg-primary text-primary-foreground text-sm font-semibold">Save User</button>
            </form>
        </div>

        @foreach($users as $u)
            <div x-show="editOpen === '{{ $u->id }}'" x-transition.opacity class="fixed inset-0 z-50 grid place-items-center p-4" style="display:none">
                <button @click="editOpen = null" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></button>
                <form method="POST" action="{{ route('dashboard.users.update', $u->id) }}" class="relative w-full max-w-xl rounded-2xl border border-border bg-background p-6">
                    @csrf @method('PATCH')
                    <div class="flex items-center justify-between mb-5"><h3 class="font-display font-bold text-xl">Edit User</h3><button type="button" @click="editOpen = null">✕</button></div>
                    <div class="grid gap-4">
                        <label class="block"><span class="block text-xs text-muted-foreground mb-2">Name</span><input name="name" value="{{ old('name', $u->name) }}" required class="w-full h-11 px-4 rounded-xl bg-card border border-border text-sm focus:outline-none focus:border-primary"></label>
                        <label class="block"><span class="block text-xs text-muted-foreground mb-2">Email</span><input type="email" name="email" value="{{ old('email', $u->email) }}" required class="w-full h-11 px-4 rounded-xl bg-card border border-border text-sm focus:outline-none focus:border-primary"></label>
                        <label class="block"><span class="block text-xs text-muted-foreground mb-2">Role</span><select name="role" required class="w-full h-11 px-4 rounded-xl bg-card border border-border text-sm focus:outline-none focus:border-primary"><option value="user" @selected(old('role', $u->role) === 'user')>User</option><option value="admin" @selected(old('role', $u->role) === 'admin')>Admin</option></select></label>
                        <label class="block"><span class="block text-xs text-muted-foreground mb-2">New Password</span><input type="password" name="password" minlength="8" class="w-full h-11 px-4 rounded-xl bg-card border border-border text-sm focus:outline-none focus:border-primary"><span class="block mt-2 text-xs text-muted-foreground">Leave blank to keep current password.</span></label>
                    </div>
                    <button class="mt-5 h-11 px-5 rounded-full bg-primary text-primary-foreground text-sm font-semibold">Update User</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
