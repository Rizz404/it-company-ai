<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanyKnowledgeItemSeeder extends Seeder
{
    public function run(): void
    {
        $company = Company::where('slug', 'it-company-ai')->firstOrFail();
        $records = [
            [
                'category' => 'general',
                'title' => 'Tentang IT Company AI',
                'body' => 'Ini adalah profil demo perusahaan IT. Layanan, harga, konsultan, dan kebijakan merupakan contoh yang harus disahkan pemilik sebelum dipakai untuk bisnis nyata.',
                'translations' => [
                    'en' => [
                        'title' => 'About IT Company AI',
                        'body' => 'This is an IT company demo. Services, prices, consultants, and policies are examples that require owner approval before real business use.',
                    ],
                    'ja' => [
                        'title' => 'IT Company AIについて',
                        'body' => 'IT企業のデモです。サービス、料金、コンサルタント、方針は例示であり、実運用前に所有者の承認が必要です。',
                    ],
                ],
                'tags' => [
                    'about',
                    'demo',
                    'profil',
                ],
                'image_url' => 'images/scenes/office.png',
            ],
            [
                'category' => 'policies',
                'title' => 'Konsultasi 60 menit',
                'body' => 'Konsultasi berlangsung 60 menit untuk 1–6 peserta. Satu konsultan menerima satu konsultasi per slot. Permintaan berstatus pending sampai dikonfirmasi admin. Pembatalan oleh admin melepaskan slot.',
                'translations' => [
                    'en' => [
                        'title' => '60-minute consultations',
                        'body' => 'Consultations last 60 minutes for 1–6 participants. Each consultant handles one consultation per slot. Requests remain pending until an administrator confirms them. An administrator cancellation releases the slot.',
                    ],
                    'ja' => [
                        'title' => '60分のご相談',
                        'body' => 'ご相談は1〜6名で60分です。各コンサルタントは1枠につき1件を担当します。管理者が確定するまでは申請中です。管理者によるキャンセルで枠が開放されます。',
                    ],
                ],
                'tags' => [
                    'consultation',
                    'konsultasi',
                    'cancel',
                    'kapasitas',
                ],
                'image_url' => 'images/scenes/meeting.png',
            ],
            [
                'category' => 'policies',
                'title' => 'Estimasi dan penawaran',
                'body' => 'Harga katalog adalah estimasi awal, bukan penawaran final. Nama layanan, estimasi harga, mata uang, dan biaya konsultasi disimpan saat pengajuan. Ruang lingkup, jadwal, dan biaya final disepakati bersama tim. Tidak ada pembayaran di situs.',
                'translations' => [
                    'en' => [
                        'title' => 'Estimates and proposals',
                        'body' => 'Catalog prices are initial estimates, not final quotes. Service name, estimated price, currency, and consultation fee are saved on submission. Final scope, timeline, and fees are agreed with the team. The website takes no payments.',
                    ],
                    'ja' => [
                        'title' => '概算とお見積り',
                        'body' => 'カタログ料金は概算で、最終見積りではありません。申請時のサービス名、概算額、通貨、相談料を保存します。最終範囲、日程、料金は担当チームと合意します。サイトでの決済はありません。',
                    ],
                ],
                'tags' => [
                    'price',
                    'harga',
                    'estimate',
                    'payment',
                ],
                'image_url' => 'images/scenes/lab.png',
            ],
            [
                'category' => 'policies',
                'title' => 'Data dan akses sistem',
                'body' => 'Jangan kirim password, API key, atau data pribadi sensitif melalui chat. Cakupan akses dan pemrosesan data dibahas melalui jalur aman bersama tim sebelum pekerjaan dimulai.',
                'translations' => [
                    'en' => [
                        'title' => 'Data and system access',
                        'body' => 'Do not send passwords, API keys, or sensitive personal data through chat. Access scope and data processing are agreed through a secure channel before work begins.',
                    ],
                    'ja' => [
                        'title' => 'データとシステムアクセス',
                        'body' => 'チャットにパスワード、APIキー、機密個人情報を送らないでください。作業開始前に安全な経路でアクセス範囲とデータ処理を合意します。',
                    ],
                ],
                'tags' => [
                    'data',
                    'privacy',
                    'security',
                    'akses',
                ],
                'image_url' => 'images/scenes/lab.png',
            ],
            [
                'category' => 'facilities',
                'title' => 'Discovery dan desain solusi',
                'body' => 'Kami memetakan kebutuhan, pengguna, integrasi, dan prioritas menjadi ruang lingkup kerja yang dapat ditinjau bersama.',
                'translations' => [
                    'en' => [
                        'title' => 'Discovery and solution design',
                        'body' => 'We map requirements, users, integrations, and priorities into a scope that can be reviewed together.',
                    ],
                    'ja' => [
                        'title' => '課題整理とソリューション設計',
                        'body' => '要件、利用者、連携、優先順位を整理し、一緒に確認できる作業範囲にまとめます。',
                    ],
                ],
                'tags' => [
                    'discovery',
                    'design',
                    'architecture',
                ],
                'image_url' => 'images/scenes/meeting.png',
            ],
            [
                'category' => 'facilities',
                'title' => 'Rekayasa dan integrasi',
                'body' => 'Kapabilitas demo mencakup web, mobile, integrasi API, AI, dan otomasi. Pemilihan teknologi mengikuti kebutuhan proyek dan hasil konsultasi.',
                'translations' => [
                    'en' => [
                        'title' => 'Engineering and integration',
                        'body' => 'Demo capabilities cover web, mobile, API integrations, AI, and automation. Technology choices follow project requirements and consultation outcomes.',
                    ],
                    'ja' => [
                        'title' => '開発とシステム連携',
                        'body' => 'デモの対応分野はWeb、モバイル、API連携、AI、自動化です。技術選定はプロジェクト要件と相談結果に基づきます。',
                    ],
                ],
                'tags' => [
                    'web',
                    'mobile',
                    'api',
                    'ai',
                    'automation',
                ],
                'image_url' => 'images/scenes/lab.png',
            ],
            [
                'category' => 'facilities',
                'title' => 'Cloud dan operasional',
                'body' => 'Tim membantu fondasi cloud, deployment, observabilitas, dan rencana dukungan. SLA dan jam dukungan hanya berlaku setelah disepakati secara tertulis.',
                'translations' => [
                    'en' => [
                        'title' => 'Cloud and operations',
                        'body' => 'The team supports cloud foundations, deployment, observability, and support planning. SLAs and support hours apply only after written agreement.',
                    ],
                    'ja' => [
                        'title' => 'クラウドと運用',
                        'body' => 'クラウド基盤、デプロイ、可観測性、サポート計画を支援します。SLAと対応時間は書面合意後に適用されます。',
                    ],
                ],
                'tags' => [
                    'cloud',
                    'deployment',
                    'support',
                    'sla',
                ],
                'image_url' => 'images/scenes/lab.png',
            ],
            [
                'category' => 'faq',
                'title' => 'Bagaimana memulai proyek?',
                'body' => 'Pilih layanan, ajukan konsultasi, lalu siapkan ringkasan tujuan bisnis. Tim meninjau permintaan dan mengonfirmasi jadwal sebelum menyusun penawaran.',
                'translations' => [
                    'en' => [
                        'title' => 'How do we start a project?',
                        'body' => 'Choose a service, request a consultation, and prepare a business goal summary. The team reviews the request and confirms the schedule before preparing a proposal.',
                    ],
                    'ja' => [
                        'title' => 'プロジェクトの始め方',
                        'body' => 'サービスを選んで相談を申請し、ビジネス目標の概要をご準備ください。担当チームが申請内容と日程を確認してから提案を作成します。',
                    ],
                ],
                'tags' => [
                    'start',
                    'project',
                    'proposal',
                    'mulai',
                ],
                'image_url' => 'images/scenes/meeting.png',
            ],
            [
                'category' => 'faq',
                'title' => 'Jam konsultasi',
                'body' => 'Slot demo dibuka Senin–Jumat pukul 09.00–17.00 Asia/Jakarta, dengan jeda pukul 12.00–13.00, hingga 60 hari ke depan. Hari libur khusus perlu dikonfirmasi tim.',
                'translations' => [
                    'en' => [
                        'title' => 'Consultation hours',
                        'body' => 'Demo slots run Monday–Friday, 09:00–17:00 Asia/Jakarta, with a 12:00–13:00 break, up to 60 days ahead. Confirm special holidays with the team.',
                    ],
                    'ja' => [
                        'title' => '相談受付時間',
                        'body' => 'デモの相談枠は月〜金、ジャカルタ時間9〜17時、12〜13時は休憩で、60日先までです。特別休業日はチームへご確認ください。',
                    ],
                ],
                'tags' => [
                    'hours',
                    'jadwal',
                    'schedule',
                    'timezone',
                ],
                'image_url' => 'images/scenes/office.png',
            ],
        ];

        foreach ($records as $index => $record) {
            $company->knowledgeItems()->updateOrCreate(['title' => $record['title']], [...$record, 'sort_order' => $index, 'is_active' => true]);
        }
    }
}
