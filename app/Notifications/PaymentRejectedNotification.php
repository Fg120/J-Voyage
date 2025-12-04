<?php

namespace App\Notifications;

use App\Models\Transaksi;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentRejectedNotification extends Notification
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
            ->subject('❌ Pembayaran Tidak Dapat Diverifikasi - ' . $transaksi->pengelola->nama_wisata)
            ->greeting('Halo ' . $transaksi->nama . ',')
            ->line('Mohon maaf, pembayaran Anda untuk pemesanan berikut tidak dapat diverifikasi:')
            ->line('')
            ->line('**Detail Pemesanan:**')
            ->line('📍 **Destinasi:** ' . $transaksi->pengelola->nama_wisata)
            ->line('📅 **Tanggal Kunjungan:** ' . $transaksi->tanggal_kunjungan->isoFormat('D MMM Y'))
            ->line('👥 **Jumlah Pengunjung:** ' . $transaksi->jumlah . ' orang')
            ->line('💰 **Total Pembayaran:** Rp ' . number_format($transaksi->total_harga, 0, ',', '.'))
            ->line('')
            ->line('**Kemungkinan penyebab:**')
            ->line('• Bukti pembayaran tidak jelas atau tidak sesuai')
            ->line('• Nominal pembayaran tidak sesuai')
            ->line('• Pembayaran tidak diterima oleh pengelola')
            ->line('')
            ->line('Silakan hubungi pengelola wisata untuk informasi lebih lanjut atau lakukan pemesanan ulang dengan bukti pembayaran yang valid.')
            ->action('Pesan Ulang', url('/destinasi/' . $transaksi->pengelola_id))
            ->line('')
            ->line('Jika Anda merasa ini adalah kesalahan, silakan hubungi pengelola wisata terkait.')
            ->line('')
            ->line('Terima kasih atas pengertian Anda.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'transaksi_id' => $this->transaksi->id,
            'type' => 'payment_rejected',
        ];
    }
}
