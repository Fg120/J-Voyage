@extends('layouts.admin.app')

@section('content')
    <div class="container px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700">
            Cek Tiket
        </h2>

        <div class="bg-neutral-800 rounded-lg shadow-lg p-6">
            <!-- Tab Navigation -->
            <div class="flex border-b border-neutral-700 mb-6">
                <button id="tab-text" onclick="switchTab('text')"
                    class="tab-btn px-6 py-3 text-white font-medium border-b-2 border-purple-500 transition-all">
                    <i data-lucide="keyboard" class="inline-block w-4 h-4 mr-2"></i>
                    Input Teks
                </button>
                <button id="tab-qr" onclick="switchTab('qr')"
                    class="tab-btn px-6 py-3 text-gray-400 font-medium border-b-2 border-transparent hover:text-white transition-all">
                    <i data-lucide="scan-line" class="inline-block w-4 h-4 mr-2"></i>
                    Scan QR
                </button>
            </div>

            <!-- Text Input Panel -->
            <div id="panel-text" class="tab-panel">
                <div class="max-w-md">
                    <label class="block text-gray-300 text-sm font-medium mb-2">Kode Tiket</label>
                    <div class="flex gap-3 flex-wrap">
                        <input type="text" id="input-kode"
                            class="flex-1 bg-neutral-700 border border-neutral-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500"
                            placeholder="Contoh: JVYG-1-ABC123">
                        <button onclick="checkTicket()" id="btn-check"
                            class="bg-purple-600 hover:bg-purple-700 text-white font-medium px-6 py-3 rounded-lg transition-colors w-full md:w-auto">
                            Cek
                        </button>
                    </div>
                </div>
            </div>

            <!-- QR Scanner Panel -->
            <div id="panel-qr" class="tab-panel hidden">
                <div class="max-w-md mx-auto">
                    <div id="qr-reader" class="rounded-lg overflow-hidden"></div>
                    <p class="text-gray-400 text-sm text-center mt-3">
                        Arahkan kamera ke QR Code tiket
                    </p>
                </div>
            </div>

            <!-- Result Panel -->
            <div id="result-panel" class="mt-8 hidden">
                <div class="border-t border-neutral-700 pt-6">
                    <h3 class="text-lg font-semibold text-white mb-4">Hasil Pengecekan</h3>

                    <!-- Loading State -->
                    <div id="result-loading" class="hidden text-center py-8">
                        <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-purple-500 mx-auto"></div>
                        <p class="text-gray-400 mt-3">Memeriksa tiket...</p>
                    </div>

                    <!-- Error State -->
                    <div id="result-error" class="hidden bg-red-900/30 border border-red-700 rounded-lg p-4">
                        <div class="flex items-center gap-3">
                            <div class="bg-red-600 rounded-full p-2">
                                <i data-lucide="x" class="w-5 h-5 text-white"></i>
                            </div>
                            <div>
                                <p class="text-red-400 font-semibold">Tiket Tidak Valid</p>
                                <p id="error-message" class="text-red-300 text-sm"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Success State -->
                    <div id="result-success" class="hidden">
                        <!-- Status Badge -->
                        <div id="status-badge" class="mb-4"></div>

                        <!-- Ticket Details -->
                        <div class="bg-neutral-700/50 rounded-lg p-5 space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-gray-400 text-xs uppercase tracking-wider">Kode Tiket</p>
                                    <p id="detail-kode" class="text-white font-mono font-semibold"></p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs uppercase tracking-wider">Nama Pemesan</p>
                                    <p id="detail-nama" class="text-white font-semibold"></p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs uppercase tracking-wider">Tanggal Kunjungan</p>
                                    <p id="detail-tanggal" class="text-white"></p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs uppercase tracking-wider">Jumlah</p>
                                    <p id="detail-jumlah" class="text-white"></p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs uppercase tracking-wider">Email</p>
                                    <p id="detail-email" class="text-white"></p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs uppercase tracking-wider">Total Harga</p>
                                    <p id="detail-harga" class="text-white"></p>
                                </div>
                            </div>

                            <div id="scanned-info" class="hidden border-t border-neutral-600 pt-4">
                                <p class="text-gray-400 text-xs uppercase tracking-wider">Di-scan pada</p>
                                <p id="detail-scanned" class="text-yellow-400 font-semibold"></p>
                            </div>
                        </div>

                        <!-- Mark as Scanned Button -->
                        <div id="action-buttons" class="mt-4">
                            <button id="btn-mark-scanned" onclick="markAsScanned()"
                                class="bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-3 rounded-lg transition-colors">
                                <i data-lucide="check-circle" class="inline-block w-4 h-4 mr-2"></i>
                                Tandai Sudah Scan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include HTML5 QR Code Library with fallback -->
    <script>
        let html5QrCode = null;
        let currentTicketId = null;
        let qrLibraryLoaded = false;

        // Load Html5Qrcode library dynamically with fallback CDNs
        function loadQrLibrary() {
            return new Promise((resolve, reject) => {
                if (typeof Html5Qrcode !== 'undefined') {
                    qrLibraryLoaded = true;
                    resolve();
                    return;
                }

                const cdnUrls = [
                    'https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js',
                    'https://cdn.jsdelivr.net/npm/html5-qrcode@2.3.8/html5-qrcode.min.js',
                    'https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js'
                ];

                function tryLoadScript(index) {
                    if (index >= cdnUrls.length) {
                        reject(new Error('Failed to load QR library from all CDNs'));
                        return;
                    }

                    const script = document.createElement('script');
                    script.src = cdnUrls[index];
                    script.onload = () => {
                        qrLibraryLoaded = true;
                        resolve();
                    };
                    script.onerror = () => {
                        console.warn('Failed to load from:', cdnUrls[index]);
                        tryLoadScript(index + 1);
                    };
                    document.head.appendChild(script);
                }

                tryLoadScript(0);
            });
        }

        // Preload the library on page load
        document.addEventListener('DOMContentLoaded', function () {
            loadQrLibrary().catch(err => console.warn('QR Library preload failed:', err));
        });

        function switchTab(tab) {
            // Update tab buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('text-white', 'border-purple-500');
                btn.classList.add('text-gray-400', 'border-transparent');
            });
            document.getElementById('tab-' + tab).classList.remove('text-gray-400', 'border-transparent');
            document.getElementById('tab-' + tab).classList.add('text-white', 'border-purple-500');

            // Update panels
            document.querySelectorAll('.tab-panel').forEach(panel => panel.classList.add('hidden'));
            document.getElementById('panel-' + tab).classList.remove('hidden');

            // Handle QR scanner
            if (tab === 'qr') {
                startQrScanner();
            } else {
                stopQrScanner();
            }
        }

        function startQrScanner() {
            if (html5QrCode) return;

            const qrReader = document.getElementById('qr-reader');

            // Show loading state
            qrReader.innerHTML =
                '<div class="text-center py-8">' +
                '<div class="animate-spin rounded-full h-10 w-10 border-b-2 border-purple-500 mx-auto"></div>' +
                '<p class="text-gray-400 mt-3">Memuat scanner...</p>' +
                '</div>';

            // Load library if not loaded yet
            loadQrLibrary()
                .then(() => {
                    qrReader.innerHTML = ''; // Clear loading state

                    html5QrCode = new Html5Qrcode("qr-reader");
                    html5QrCode.start({
                        facingMode: "environment"
                    }, {
                        fps: 10,
                        qrbox: {
                            width: 250,
                            height: 250
                        }
                    },
                        (decodedText) => {
                            // QR code scanned successfully
                            stopQrScanner();
                            checkTicketByCode(decodedText);
                        },
                        (errorMessage) => {
                            // Ignore scan errors
                        }
                    ).catch((err) => {
                        console.error("Unable to start QR scanner:", err);
                        qrReader.innerHTML =
                            '<div class="bg-red-900/30 border border-red-700 rounded-lg p-4 text-center">' +
                            '<p class="text-red-400">Tidak dapat mengakses kamera.</p>' +
                            '<p class="text-red-300 text-sm mt-1">Pastikan Anda telah memberikan izin akses kamera.</p>' +
                            '</div>';
                    });
                })
                .catch((err) => {
                    console.error("Failed to load QR library:", err);
                    qrReader.innerHTML =
                        '<div class="bg-red-900/30 border border-red-700 rounded-lg p-4 text-center">' +
                        '<p class="text-red-400">Gagal memuat library QR Scanner.</p>' +
                        '<p class="text-red-300 text-sm mt-1">Silakan refresh halaman atau gunakan input teks.</p>' +
                        '</div>';
                });
        }

        function stopQrScanner() {
            if (html5QrCode) {
                html5QrCode.stop().then(() => {
                    html5QrCode = null;
                }).catch(err => console.error("Error stopping scanner:", err));
            }
        }

        function checkTicket() {
            const kode = document.getElementById('input-kode').value.trim();
            if (!kode) {
                alert('Masukkan kode tiket terlebih dahulu');
                return;
            }
            checkTicketByCode(kode);
        }

        function checkTicketByCode(kode) {
            showResultPanel();
            showLoading();

            fetch('{{ route('pengelola.cek-tiket.check') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    kode: kode
                })
            })
                .then(response => response.json())
                .then(data => {
                    hideLoading();
                    if (data.success) {
                        showSuccess(data.data);
                    } else {
                        showError(data.message);
                    }
                })
                .catch(error => {
                    hideLoading();
                    showError('Terjadi kesalahan saat memeriksa tiket.');
                    console.error('Error:', error);
                });
        }

        function showResultPanel() {
            document.getElementById('result-panel').classList.remove('hidden');
        }

        function showLoading() {
            document.getElementById('result-loading').classList.remove('hidden');
            document.getElementById('result-error').classList.add('hidden');
            document.getElementById('result-success').classList.add('hidden');
        }

        function hideLoading() {
            document.getElementById('result-loading').classList.add('hidden');
        }

        function showError(message) {
            document.getElementById('result-error').classList.remove('hidden');
            document.getElementById('result-success').classList.add('hidden');
            document.getElementById('error-message').textContent = message;
        }

        function showSuccess(data) {
            currentTicketId = data.id;
            document.getElementById('result-error').classList.add('hidden');
            document.getElementById('result-success').classList.remove('hidden');

            // Fill in details
            document.getElementById('detail-kode').textContent = data.kode;
            document.getElementById('detail-nama').textContent = data.nama;
            document.getElementById('detail-tanggal').textContent = data.tanggal_kunjungan;
            document.getElementById('detail-jumlah').textContent = data.jumlah + ' Orang';
            document.getElementById('detail-email').textContent = data.email;
            document.getElementById('detail-harga').textContent = 'Rp ' + data.total_harga;

            // Status badge
            const statusBadge = document.getElementById('status-badge');
            if (data.is_scanned) {
                statusBadge.innerHTML =
                    '<div class="inline-flex items-center gap-2 bg-yellow-900/30 border border-yellow-700 rounded-full px-4 py-2">' +
                    '<i data-lucide="alert-circle" class="w-5 h-5 text-yellow-400"></i>' +
                    '<span class="text-yellow-400 font-semibold">Sudah Di-scan</span></div>';
                document.getElementById('scanned-info').classList.remove('hidden');
                document.getElementById('detail-scanned').textContent = data.scanned_at;
                document.getElementById('action-buttons').classList.add('hidden');
            } else {
                statusBadge.innerHTML =
                    '<div class="inline-flex items-center gap-2 bg-green-900/30 border border-green-700 rounded-full px-4 py-2">' +
                    '<i data-lucide="check-circle" class="w-5 h-5 text-green-400"></i>' +
                    '<span class="text-green-400 font-semibold">Tiket Valid</span></div>';
                document.getElementById('scanned-info').classList.add('hidden');
                document.getElementById('action-buttons').classList.remove('hidden');
            }

            // Re-initialize Lucide icons
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }

        function markAsScanned() {
            if (!currentTicketId) return;

            const btn = document.getElementById('btn-mark-scanned');
            btn.disabled = true;
            btn.innerHTML =
                '<div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white inline-block mr-2"></div> Memproses...';

            fetch('{{ url('pengelola/cek-tiket') }}/' + currentTicketId + '/scan', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update UI to show scanned state
                        const statusBadge = document.getElementById('status-badge');
                        statusBadge.innerHTML =
                            '<div class="inline-flex items-center gap-2 bg-green-900/30 border border-green-700 rounded-full px-4 py-2">' +
                            '<i data-lucide="check-circle" class="w-5 h-5 text-green-400"></i>' +
                            '<span class="text-green-400 font-semibold">Berhasil Di-scan!</span></div>';

                        document.getElementById('scanned-info').classList.remove('hidden');
                        document.getElementById('detail-scanned').textContent = data.scanned_at;
                        document.getElementById('action-buttons').classList.add('hidden');

                        if (typeof lucide !== 'undefined') {
                            lucide.createIcons();
                        }
                    } else {
                        alert(data.message);
                        btn.disabled = false;
                        btn.innerHTML =
                            '<i data-lucide="check-circle" class="inline-block w-4 h-4 mr-2"></i> Tandai Sudah Scan';
                    }
                })
                .catch(error => {
                    alert('Terjadi kesalahan saat memproses.');
                    btn.disabled = false;
                    btn.innerHTML =
                        '<i data-lucide="check-circle" class="inline-block w-4 h-4 mr-2"></i> Tandai Sudah Scan';
                    console.error('Error:', error);
                });
        }

        // Cleanup on page unload
        window.addEventListener('beforeunload', stopQrScanner);
    </script>
@endsection