<?php

namespace App\Notifications;

use App\Models\Transaksi;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentApprovedNotification extends Notification
{
    protected Transaksi $transaksi;

    public function __construct(Transaksi $transaksi)
    {
        $this->transaksi = $transaksi;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $transaksi = $this->transaksi;

        return (new MailMessage)
            ->subject('🎉 Pembayaran Disetujui - ' . $transaksi->pengelola->nama_wisata)
            ->greeting('Halo ' . $transaksi->nama . '!')
            ->line('Selamat! Pembayaran Anda telah diverifikasi dan tiket Anda sudah siap.')
            ->line('')
            ->line('**Detail Tiket:**')
            ->line('🎫 **Kode Tiket:** ' . $transaksi->kode)
            ->line('📍 **Destinasi:** ' . $transaksi->pengelola->nama_wisata)
            ->line('📅 **Tanggal Kunjungan:** ' . $transaksi->tanggal_kunjungan->isoFormat('D MMM Y'))
            ->line('👥 **Jumlah Pengunjung:** ' . $transaksi->jumlah . ' orang')
            ->line('💰 **Total Pembayaran:** Rp ' . number_format($transaksi->total_harga, 0, ',', '.'))
            ->line('')
            ->action('Lihat Tiket', url('/profile/riwayat/tiket/' . $transaksi->id))
            ->line('')
            ->line('**Informasi Penting:**')
            ->line('• Tunjukkan QR Code atau Kode Tiket saat check-in')
            ->line('• Tiket berlaku untuk tanggal yang tertera')
            ->line('• Datang 15 menit sebelum waktu kunjungan')
            ->line('')
            ->line('Terima kasih telah menggunakan J-Voyage. Selamat menikmati wisata Anda! 🌴');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'transaksi_id' => $this->transaksi->id,
            'type' => 'payment_approved',
        ];
    }
}
