@extends('Admin.layoutsAdmin.app')

@section('title', 'Manajemen Pengguna')

@section('styles')
<style>
        /* Custom styles for better UI */
        .modal-box {
            max-height: 85vh;
            overflow-y: auto;
        }

        .modal-box::-webkit-scrollbar {
            width: 6px;
        }

        .modal-box::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .modal-box::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        .modal-box::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Badge styling */
        .badge-success {
            background-color: #10b981 !important;
            color: white !important;
            border: none;
        }

        .badge-warning {
            background-color: #f59e0b !important;
            color: white !important;
            border: none;
        }

        .badge-primary {
            background-color: #3b82f6 !important;
            color: white !important;
            border: none;
        }

        /* Table row hover effect */
        tr:hover {
            background-color: #f9fafb !important;
        }

        /* Pagination styling */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
        }

        .pagination .page-item.active .page-link {
            background-color: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .pagination .page-link {
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            color: #4b5563;
            transition: all 0.2s ease;
        }

        .pagination .page-link:hover {
            background-color: #f3f4f6;
            border-color: #9ca3af;
        }
    </style>
@endsection

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Daftar Pengguna</h2>
                <p class="text-gray-600 mt-1">Kelola data pengguna yang terdaftar di sistem</p>
            </div>
            <div class="flex items-center space-x-2">
                <div class="stats shadow bg-white border border-gray-200">
                    <div class="stat">
                        <div class="stat-title">Total Pengguna</div>
                        <div class="stat-value text-primary">{{ $users->total() }}</div>
                        <div class="stat-desc">{{ $users->count() }} ditampilkan</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left py-4 px-6 font-semibold text-gray-700">Pengguna</th>
                            <th class="text-left py-4 px-6 font-semibold text-gray-700">Email</th>
                            <th class="text-left py-4 px-6 font-semibold text-gray-700">Login dengan</th>
                            <th class="text-left py-4 px-6 font-semibold text-gray-700">Terdaftar</th>
                            <th class="text-left py-4 px-6 font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors duration-200" data-user-id="{{ $user->id }}"
                                data-user-name="{{ $user->name }}" data-user-email="{{ $user->email }}"
                                data-user-avatar="{{ $user->avatar }}" data-user-is-admin="{{ $user->is_admin }}"
                                data-user-email-verified="{{ $user->email_verified_at ? 'true' : 'false' }}"
                                data-user-google-id="{{ $user->google_id ?? 'null' }}"
                                data-user-phone="{{ $user->phone ?? 'null' }}"
                                data-user-dob="{{ $user->date_of_birth ? $user->date_of_birth->format('d F Y') : 'null' }}"
                                data-user-address="{{ $user->address ?? 'null' }}"
                                data-user-created="{{ $user->created_at->format('d F Y H:i') }}"
                                data-user-updated="{{ $user->updated_at->format('d M Y') }}">
                                <td class="py-4 px-6">
                                    <div class="flex items-center space-x-3">
                                        <div class="avatar">
                                            @if ($user->avatar)
                                                <div class="w-12 h-12 rounded-full ring-2 ring-gray-200 ring-offset-2">
                                                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}" />
                                                </div>
                                            @else
                                                <div
                                                    class="w-12 h-12 rounded-full bg-linear-to-r from-blue-500 to-purple-500 text-white flex items-center justify-center ring-2 ring-blue-100">
                                                    <i class="fas fa-user text-lg"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-500">
                                                @if ($user->is_admin)
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        <i class="fas fa-shield-alt mr-1"></i> Administrator
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <i class="fas fa-user mr-1"></i> User
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="text-gray-900">{{ $user->email }}</div>
                                    @if ($user->email_verified_at)
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i> Terverifikasi
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-clock mr-1"></i> Belum Verifikasi
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    @if ($user->google_id)
                                        <div class="flex items-center">
                                            <img src="https://img.icons8.com/color/24/000000/google-logo.png" alt="Google"
                                                class="w-5 h-5 mr-2">
                                            <span class="text-gray-700">Google</span>
                                        </div>
                                    @else
                                        <div class="flex items-center">
                                            <i class="fas fa-envelope text-gray-400 mr-2"></i>
                                            <span class="text-gray-700">Email</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    <div class="text-gray-900">{{ $user->created_at->format('d M Y') }}</div>
                                    <div class="text-sm text-gray-500">{{ $user->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center space-x-2">
                                        <button onclick="showUserDetails(this.closest('tr'))"
                                            class="btn btn-sm btn-outline btn-info">
                                            <i class="fas fa-eye mr-1"></i> Detail
                                        </button>

                                        @if (!$user->is_admin)
                                            <button onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')"
                                                class="btn btn-sm btn-outline btn-error">
                                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                                            </button>
                                        @else
                                            <button class="btn btn-sm btn-outline btn-disabled" disabled>
                                                <i class="fas fa-lock mr-1"></i> Tidak dapat dihapus
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 px-6 text-center">
                                    <div class="text-gray-400">
                                        <i class="fas fa-users text-4xl mb-3"></i>
                                        <p class="text-lg">Tidak ada pengguna lain</p>
                                        <p class="text-sm mt-1">Semua pengguna ditampilkan di sini</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($users->hasPages())
                <div class="border-t border-gray-200 px-6 py-4">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- User Detail Modal -->
    <dialog id="userDetailModal" class="modal">
        <div class="modal-box max-w-2xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <div id="userDetailContent">
                <!-- Content will be dynamically inserted here -->
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <!-- Delete Confirmation Modal -->
    <dialog id="deleteModal" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-lg">Konfirmasi Hapus Pengguna</h3>
            <p class="py-4">Anda yakin ingin menghapus pengguna <span id="deleteUserName" class="font-semibold"></span>?
            </p>
            <p class="text-sm text-red-600 mb-4">
                <i class="fas fa-exclamation-triangle mr-1"></i>
                Tindakan ini tidak dapat dibatalkan. Semua data pengguna akan dihapus secara permanen.
            </p>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-ghost">Batal</button>
                </form>
                <form id="deleteForm" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error">
                        <i class="fas fa-trash-alt mr-2"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </dialog>
@endsection

@section('scripts')
    <script>
        // Show user details modal
        function showUserDetails(row) {
            const userData = {
                id: row.getAttribute('data-user-id'),
                name: row.getAttribute('data-user-name'),
                email: row.getAttribute('data-user-email'),
                avatar: row.getAttribute('data-user-avatar'),
                isAdmin: row.getAttribute('data-user-is-admin') === '1',
                emailVerified: row.getAttribute('data-user-email-verified') === 'true',
                googleId: row.getAttribute('data-user-google-id'),
                phone: row.getAttribute('data-user-phone'),
                dob: row.getAttribute('data-user-dob'),
                address: row.getAttribute('data-user-address'),
                created: row.getAttribute('data-user-created'),
                updated: row.getAttribute('data-user-updated')
            };

            // Build user details HTML
            const userDetailsHTML = `
            <h3 class="text-xl font-bold mb-4">Detail Pengguna</h3>

            <div class="flex flex-col md:flex-row gap-6 mb-6">
                <!-- Profile Picture -->
                <div class="flex-shrink-0">
                    ${userData.avatar && userData.avatar !== 'null' ?
                        `<img src="${userData.avatar}" alt="${userData.name}"
                                 class="w-32 h-32 rounded-full ring-4 ring-gray-200 object-cover">` :
                        `<div class="w-32 h-32 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 text-white flex items-center justify-center ring-4 ring-blue-100">
                                <i class="fas fa-user text-4xl"></i>
                            </div>`
                    }
                </div>

                <!-- User Info -->
                <div class="flex-1">
                    <h4 class="text-2xl font-bold text-gray-800 mb-2">${userData.name}</h4>

                    <div class="space-y-3">
                        <div>
                            <span class="font-semibold text-gray-700">Email:</span>
                            <span class="ml-2">${userData.email}</span>
                            ${userData.emailVerified ?
                                `<span class="ml-2 badge badge-success">
                                        <i class="fas fa-check-circle mr-1"></i> Terverifikasi
                                    </span>` :
                                `<span class="ml-2 badge badge-warning">
                                        <i class="fas fa-clock mr-1"></i> Belum Verifikasi
                                    </span>`
                            }
                        </div>

                        <div>
                            <span class="font-semibold text-gray-700">Role:</span>
                            ${userData.isAdmin ?
                                `<span class="ml-2 badge badge-primary">
                                        <i class="fas fa-shield-alt mr-1"></i> Administrator
                                    </span>` :
                                `<span class="ml-2 badge badge-success">
                                        <i class="fas fa-user mr-1"></i> User
                                    </span>`
                            }
                        </div>

                        <div>
                            <span class="font-semibold text-gray-700">Login Method:</span>
                            ${userData.googleId !== 'null' ?
                                `<span class="ml-2 flex items-center">
                                        <img src="https://img.icons8.com/color/24/000000/google-logo.png" alt="Google" class="w-5 h-5 mr-2">
                                        Google OAuth
                                    </span>` :
                                `<span class="ml-2 flex items-center">
                                        <i class="fas fa-envelope text-gray-400 mr-2"></i>
                                        Email & Password
                                    </span>`
                            }
                        </div>

                        <div>
                            <span class="font-semibold text-gray-700">Terdaftar:</span>
                            <span class="ml-2">${userData.created}</span>
                        </div>

                        ${userData.phone !== 'null' ? `
                            <div>
                                <span class="font-semibold text-gray-700">Telepon:</span>
                                <span class="ml-2">${userData.phone}</span>
                            </div>
                            ` : ''}

                        ${userData.dob !== 'null' ? `
                            <div>
                                <span class="font-semibold text-gray-700">Tanggal Lahir:</span>
                                <span class="ml-2">${userData.dob}</span>
                            </div>
                            ` : ''}

                        ${userData.address !== 'null' ? `
                            <div>
                                <span class="font-semibold text-gray-700">Alamat:</span>
                                <p class="ml-2 mt-1 text-gray-600">${userData.address}</p>
                            </div>
                            ` : ''}
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                <div class="stat bg-base-200 rounded-lg p-4">
                    <div class="stat-title">ID Pengguna</div>
                    <div class="stat-value text-lg font-mono">${userData.id}</div>
                </div>

                <div class="stat bg-base-200 rounded-lg p-4">
                    <div class="stat-title">Terakhir Diupdate</div>
                    <div class="stat-value text-lg">${userData.updated}</div>
                </div>

                <div class="stat bg-base-200 rounded-lg p-4">
                    <div class="stat-title">Provider</div>
                    <div class="stat-value text-lg">
                        ${userData.googleId !== 'null' ? 'Google' : 'Email'}
                    </div>
                </div>
            </div>

            <div class="alert alert-info">
                <div class="flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    <span>
                        Data pengguna ini diambil dari database. Pengguna yang login dengan Google tidak memiliki password di sistem.
                    </span>
                </div>
            </div>
        `;

            // Insert content into modal
            document.getElementById('userDetailContent').innerHTML = userDetailsHTML;

            // Show modal
            document.getElementById('userDetailModal').showModal();
        }

        // Confirm delete user
        function confirmDelete(userId, userName) {
            // Set user name in modal
            document.getElementById('deleteUserName').textContent = userName;

            // Set form action
            document.getElementById('deleteForm').action = `/admin/users/${userId}`;

            // Show modal
            document.getElementById('deleteModal').showModal();
        }

        // Auto-close success/error messages after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    alert.style.opacity = '0';
                    alert.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);
        });
    </script>
@endsection
