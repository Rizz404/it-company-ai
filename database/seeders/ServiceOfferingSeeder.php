<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class ServiceOfferingSeeder extends Seeder
{
    public function run(): void
    {
        $company = Company::where('slug', 'it-company-ai')->firstOrFail();
        $records = [
            [
                'slug' => 'web-platform',
                'category' => 'web',
                'name' => 'Platform Web',
                'description' => 'Website dan aplikasi web yang disusun sesuai alur bisnis Anda.',
                'translations' => [
                    'en' => [
                        'name' => 'Web Platform',
                        'description' => 'Websites and web applications shaped around your business workflows.',
                    ],
                    'ja' => [
                        'name' => 'Webプラットフォーム',
                        'description' => '業務フローに合わせたウェブサイトとWebアプリケーション。',
                    ],
                ],
                'price' => 25000000,
                'delivery_days' => 30,
                'delivery_model' => 'remote',
                'tags' => [
                    'scalable',
                    'secure',
                ],
                'prerequisites' => [
                    'business_brief',
                    'brand_assets',
                ],
                'image_url' => 'images/scenes/lab.png',
                'is_featured' => true,
                'is_unavailable' => false,
            ],
            [
                'slug' => 'mobile-product',
                'category' => 'mobile',
                'name' => 'Produk Mobile',
                'description' => 'Aplikasi mobile untuk pengalaman pelanggan dan operasional tim.',
                'translations' => [
                    'en' => [
                        'name' => 'Mobile Product',
                        'description' => 'Mobile applications for customer experiences and team operations.',
                    ],
                    'ja' => [
                        'name' => 'モバイルプロダクト',
                        'description' => '顧客体験とチーム運営を支えるモバイルアプリ。',
                    ],
                ],
                'price' => 45000000,
                'delivery_days' => 45,
                'delivery_model' => 'remote',
                'tags' => [
                    'scalable',
                    'automation',
                ],
                'prerequisites' => [
                    'business_brief',
                    'api_access',
                ],
                'image_url' => 'images/scenes/lab.png',
                'is_featured' => true,
                'is_unavailable' => false,
            ],
            [
                'slug' => 'ai-workflow',
                'category' => 'ai_automation',
                'name' => 'AI & Otomasi',
                'description' => 'Asisten AI dan otomasi alur kerja dengan batas akses yang jelas.',
                'translations' => [
                    'en' => [
                        'name' => 'AI & Automation',
                        'description' => 'AI assistants and workflow automation with clearly defined access boundaries.',
                    ],
                    'ja' => [
                        'name' => 'AIと自動化',
                        'description' => '明確なアクセス制御を備えたAIアシスタントと業務自動化。',
                    ],
                ],
                'price' => 35000000,
                'delivery_days' => 30,
                'delivery_model' => 'remote',
                'tags' => [
                    'automation',
                    'secure',
                ],
                'prerequisites' => [
                    'business_brief',
                    'sample_data',
                ],
                'image_url' => 'images/scenes/lab.png',
                'is_featured' => true,
                'is_unavailable' => false,
            ],
            [
                'slug' => 'cloud-foundation',
                'category' => 'cloud',
                'name' => 'Fondasi Cloud',
                'description' => 'Arsitektur cloud, pipeline deployment, dan observabilitas layanan.',
                'translations' => [
                    'en' => [
                        'name' => 'Cloud Foundation',
                        'description' => 'Cloud architecture, deployment pipelines, and service observability.',
                    ],
                    'ja' => [
                        'name' => 'クラウド基盤',
                        'description' => 'クラウド設計、デプロイパイプライン、サービスの可観測性。',
                    ],
                ],
                'price' => 20000000,
                'delivery_days' => 21,
                'delivery_model' => 'remote',
                'tags' => [
                    'cloud_native',
                    'managed',
                ],
                'prerequisites' => [
                    'infrastructure_access',
                    'business_brief',
                ],
                'image_url' => 'images/scenes/lab.png',
                'is_featured' => false,
                'is_unavailable' => false,
            ],
            [
                'slug' => 'security-review',
                'category' => 'security',
                'name' => 'Tinjauan Keamanan',
                'description' => 'Penilaian konfigurasi dan prioritas perbaikan berdasarkan cakupan yang disepakati.',
                'translations' => [
                    'en' => [
                        'name' => 'Security Review',
                        'description' => 'Configuration assessment and remediation priorities within an agreed scope.',
                    ],
                    'ja' => [
                        'name' => 'セキュリティレビュー',
                        'description' => '合意した範囲での設定評価と改善優先順位の整理。',
                    ],
                ],
                'price' => 15000000,
                'delivery_days' => 14,
                'delivery_model' => 'remote',
                'tags' => [
                    'secure',
                ],
                'prerequisites' => [
                    'written_authorization',
                    'system_scope',
                ],
                'image_url' => 'images/scenes/lab.png',
                'is_featured' => false,
                'is_unavailable' => false,
            ],
            [
                'slug' => 'managed-support',
                'category' => 'support',
                'name' => 'Dukungan Terkelola',
                'description' => 'Dukungan operasional dengan jadwal dan ruang lingkup yang disepakati tim.',
                'translations' => [
                    'en' => [
                        'name' => 'Managed Support',
                        'description' => 'Operational support with schedules and scope agreed with the team.',
                    ],
                    'ja' => [
                        'name' => 'マネージドサポート',
                        'description' => 'チームで合意した時間と範囲での運用サポート。',
                    ],
                ],
                'price' => 7500000,
                'delivery_days' => 30,
                'delivery_model' => 'remote',
                'tags' => [
                    'managed',
                    'cloud_native',
                ],
                'prerequisites' => [
                    'system_scope',
                    'infrastructure_access',
                ],
                'image_url' => 'images/scenes/lab.png',
                'is_featured' => false,
                'is_unavailable' => false,
            ],
        ];

        foreach ($records as $index => $record) {
            $company->serviceOfferings()->updateOrCreate(['slug' => $record['slug']], [...$record, 'sort_order' => $index, 'is_active' => true]);
        }
    }
}
