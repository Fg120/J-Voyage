<?php

namespace App\Notifications;

use App\Models\Transaksi;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketScannedNotification extends Notification
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
            ->subject('✅ Tiket Berhasil Di-scan - ' . $transaksi->pengelola->nama_wisata)
            ->greeting('Halo ' . $transaksi->nama . '!')
            ->line('Tiket Anda telah berhasil di-scan dan diverifikasi.')
            ->line('')
            ->line('**Detail Check-in:**')
            ->line('🎫 **Kode Tiket:** ' . $transaksi->kode)
            ->line('📍 **Lokasi:** ' . $transaksi->pengelola->nama_wisata)
            ->line('⏰ **Waktu Scan:** ' . $transaksi->scanned_at->format('d M Y, H:i') . ' WIB')
            ->line('👥 **Jumlah Pengunjung:** ' . $transaksi->jumlah . ' orang')
            ->line('')
            ->line('🌴 **Selamat menikmati wisata Anda!**')
            ->line('')
            ->line('Terima kasih telah berkunjung ke ' . $transaksi->pengelola->nama_wisata . '. Semoga pengalaman Anda menyenangkan!')
            ->line('')
            ->line('Jangan lupa untuk:')
            ->line('• Menjaga kebersihan lingkungan wisata')
            ->line('• Mengikuti aturan yang berlaku')
            ->line('• Berbagi pengalaman Anda dengan keluarga dan teman')
            ->action('Jelajahi Destinasi Lain', url('/destinasi'))
            ->line('')
            ->line('Sampai jumpa kembali di J-Voyage! 👋');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'transaksi_id' => $this->transaksi->id,
            'type' => 'ticket_scanned',
        ];
    }
}
