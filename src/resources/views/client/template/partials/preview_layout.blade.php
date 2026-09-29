<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $website['seo']['title'] ?? 'Website Preview' }}
    </title>

    <meta
        name="description"
        content="{{ $website['seo']['description'] ?? '' }}"
    >

    <style>
        :root {
            --primary: {{ $website['style']['primary'] ?? '#0369a1' }};
            --secondary: {{ $website['style']['secondary'] ?? '#e0f2fe' }};
            --background: {{ $website['style']['background'] ?? '#f8fafc' }};
            --text: {{ $website['style']['text'] ?? '#1e293b' }};
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--background);
            color: var(--text);
            font-family: Arial, sans-serif;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            width: min(1180px, calc(100% - 32px));
            margin: auto;
        }

        .topbar {
            background: var(--primary);
            color: white;
        }

        .nav {
            min-height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .logo {
            font-size: 20px;
            font-weight: 800;
            white-space: nowrap;
        }

        .menu {
            display: flex;
            align-items: center;
            gap: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .hero {
            background: white;
            margin-top: 20px;
            border-radius: 16px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1.1fr .9fr;
            min-height: 340px;
        }

        .hero-content {
            padding: 48px;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        .badge {
            color: var(--primary);
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: 14px;
        }

        .hero h1 {
            font-size: clamp(32px, 4vw, 52px);
            line-height: 1.05;
            margin: 0;
        }

        .highlight {
            color: var(--primary);
        }

        .hero p {
            color: #64748b;
            line-height: 1.7;
            max-width: 580px;
            font-size: 14px;
            margin: 20px 0;
        }

        .button {
            display: inline-flex;
            width: fit-content;
            padding: 12px 20px;
            border-radius: 10px;
            background: var(--primary);
            color: white;
            font-size: 13px;
            font-weight: 700;
        }

        .hero-image {
            min-height: 340px;
            background: #e2e8f0;
        }

        .hero-image img {
            width: 100%;
            height: 100%;
            min-height: 340px;
            object-fit: cover;
        }

        .section {
            margin-top: 20px;
            background: white;
            border-radius: 16px;
            padding: 24px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 18px;
        }

        .categories {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .category {
            padding: 10px 14px;
            border-radius: 10px;
            background: var(--secondary);
            color: var(--primary);
            font-size: 12px;
            font-weight: 700;
        }

        .products {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
        }

        .product {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            background: white;
        }

        .product-image {
            aspect-ratio: 1;
            background: #f1f5f9;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-content {
            padding: 12px;
        }

        .product-name {
            font-size: 13px;
            font-weight: 700;
            min-height: 36px;
        }

        .price {
            color: var(--primary);
            font-weight: 800;
            margin-top: 10px;
        }

        .old-price {
            color: #94a3b8;
            font-size: 10px;
            text-decoration: line-through;
        }

        .rating {
            font-size: 10px;
            color: #64748b;
            margin-top: 6px;
        }

        .info {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .info-card {
            padding: 18px;
            border-radius: 12px;
            background: var(--secondary);
        }

        .info-card strong {
            display: block;
            font-size: 12px;
            margin-bottom: 7px;
        }

        .info-card span {
            font-size: 12px;
            color: #64748b;
        }

        footer {
            margin-top: 20px;
            padding: 36px 0;
            background: #0f172a;
            color: white;
        }

        footer p,
        footer span {
            color: #94a3b8;
            font-size: 12px;
        }

        @media (max-width: 900px) {
            .menu {
                display: none;
            }

            .hero {
                grid-template-columns: 1fr;
            }

            .hero-content {
                padding: 32px;
            }

            .products {
                grid-template-columns: repeat(2, 1fr);
            }

            .info {
                grid-template-columns: 1fr;
            }
        }
    </style>

</head>

<body>

<header class="topbar">

    <div class="container nav">

        <div class="logo">
            {{ $website['header']['logo_text'] ?? $website['header']['site_name'] ?? 'YOUR BRAND' }}
        </div>

        <nav class="menu">

            @foreach($website['header']['menu'] ?? [] as $menu)

                <span>
                    {{ $menu }}
                </span>

            @endforeach

        </nav>

        <span
            style="
                padding:8px 14px;
                border-radius:8px;
                background:white;
                color:var(--primary);
                font-size:11px;
                font-weight:800;
            "
        >
            {{ $website['header']['button_text'] ?? 'Get Started' }}
        </span>

    </div>

</header>

<main class="container">

    <section class="hero">

        <div class="hero-content">

            <div class="badge">
                {{ $website['header']['badge'] ?? '' }}
            </div>

            <h1>

                {{ $website['body']['hero_title'] ?? '' }}

                @if(!empty($website['body']['hero_highlight']))

                    <span class="highlight">
                        {{ $website['body']['hero_highlight'] }}
                    </span>

                @endif

            </h1>

            <p>
                {{ $website['body']['hero_description'] ?? '' }}
            </p>

            <a href="#" class="button">
                {{ $website['body']['button_text'] ?? 'Explore' }}
            </a>

        </div>

        <div class="hero-image">

            <img
                src="{{ asset($website['body']['hero_image'] ?? 'tech1.png') }}"
                alt="{{ $website['header']['site_name'] ?? 'Website' }}"
            >

        </div>

    </section>

    @if(($website['layout'] ?? '') === 'shop')

        <section class="section">

            <div class="section-title">
                Kategori
            </div>

            <div class="categories">

                @foreach($website['body']['categories'] ?? [] as $category)

                    <span class="category">
                        {{ $category }}
                    </span>

                @endforeach

            </div>

        </section>

    @endif

    <section class="section">

        <div class="section-title">
            {{ $website['body']['promo_title'] ?? 'Featured Products' }}
        </div>

        <p style="color:#64748b;font-size:13px;margin-top:-10px;margin-bottom:20px;">
            {{ $website['body']['promo_description'] ?? '' }}
        </p>

        <div class="products">

            @foreach($website['body']['products'] ?? [] as $product)

                <article class="product">

                    <div class="product-image">

                        <img
                            src="{{ asset($product['image'] ?? 'tech1.png') }}"
                            alt="{{ $product['name'] ?? 'Product' }}"
                        >

                    </div>

                    <div class="product-content">

                        <div class="product-name">
                            {{ $product['name'] ?? 'Product' }}
                        </div>

                        <div class="price">
                            Rp {{ number_format($product['price'] ?? 0, 0, ',', '.') }}
                        </div>

                        @if(!empty($product['old_price']))

                            <div class="old-price">
                                Rp {{ number_format($product['old_price'], 0, ',', '.') }}
                            </div>

                        @endif

                        <div class="rating">
                            ★ {{ $product['rating'] ?? '0.0' }}
                            · {{ $product['sold'] ?? 0 }} terjual
                        </div>

                    </div>

                </article>

            @endforeach

        </div>

    </section>

    <section class="section">

        <div class="section-title">
            Contact
        </div>

        <div class="info">

            <div class="info-card">
                <strong>Phone</strong>
                <span>
                    {{ $website['sidebar']['phone'] ?? '-' }}
                </span>
            </div>

            <div class="info-card">
                <strong>Address</strong>
                <span>
                    {{ $website['sidebar']['address'] ?? '-' }}
                </span>
            </div>

            <div class="info-card">
                <strong>WhatsApp</strong>
                <span>
                    {{ $website['sidebar']['whatsapp'] ?? '-' }}
                </span>
            </div>

        </div>

    </section>

</main>

<footer>

    <div class="container">

        <strong>
            {{ $website['header']['site_name'] ?? 'Bisma Labs' }}
        </strong>

        <p>
            {{ $website['footer']['description'] ?? '' }}
        </p>

        <span>
            {{ $website['footer']['copyright'] ?? '' }}
        </span>

    </div>

</footer>

</body>
</html>