<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>How to use the UTM Builder</title>
    <style>
        *,::after,::before{box-sizing:border-box;margin:0;padding:0}
        body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Arial,Helvetica,sans-serif;background-color:#F2F5F1;color:#16231D;line-height:1.6}

        /* Sticky, not static - stays visible at the top while the guide
           content below scrolls underneath it, instead of scrolling
           away with the rest of the page. */
        .app-header{
            position:sticky;top:0;z-index:10;
            display:flex;align-items:center;justify-content:space-between;
            padding:0.9rem 1.75rem;background-color:#fff;border-bottom:1px solid #DCE3DC;
        }
        .app-name{font-size:1.05rem;font-weight:700;color:#1F4B3F;text-decoration:none;letter-spacing:-0.01em;white-space:nowrap}
        .header-link{
            display:inline-flex;align-items:center;gap:0.35rem;font-size:0.85rem;font-weight:700;
            color:#1F4B3F;text-decoration:none;border:1px solid #C9D3C8;border-radius:999px;
            padding:0.45rem 1.05rem;transition:background-color .15s ease;white-space:nowrap;flex-shrink:0;
        }
        .header-link:hover{background-color:#EEF1EC}

        .content{padding:2.5rem 1.25rem}
        .wrap{max-width:42rem;margin:0 auto}

        h1{font-size:1.55rem;font-weight:700;color:#1F4B3F;letter-spacing:-0.01em}
        .lede{margin-top:0.5rem;color:#5C6B60;font-size:0.95rem;max-width:34rem}

        .card{margin-top:1.75rem;background-color:#fff;border:1px solid #DCE3DC;border-radius:14px;padding:2rem;box-shadow:0 1px 3px rgba(20,32,26,0.04)}
        h2{font-size:1rem;color:#16231D;margin-top:1.6rem}
        h2:first-child{margin-top:0}
        p, li{font-size:0.9rem;color:#3d4a42;margin-top:0.5rem}
        ul{padding-left:1.25rem;margin-top:0.5rem}
        code{background-color:#EEF1EC;padding:0.1rem 0.4rem;border-radius:4px;font-size:0.85rem;color:#1F4B3F}
        b{color:#1F4B3F}
    </style>
</head>
<body>
    <div class="app-header">
        <a href="/" class="app-name">UTM Builder</a>
        <a href="/" class="header-link">&larr; Back to Builder</a>
    </div>

    <div class="content">
        <div class="wrap">
            <h1>How to use this, and how to post the link without hurting your data</h1>
            <p class="lede">A short guide to filling in the builder correctly and sharing the link safely.</p>

            <div class="card">
                <h2>1. Fill in the fields</h2>
                <p>Website URL, Campaign Source, and Campaign Medium are required. Campaign Name is required too - it's what groups everything from one push together. Content and Term are optional extras, only needed in specific cases (see their own help text on the builder).</p>

                <h2>2. Keep it lowercase and simple - already done for you</h2>
                <p>GA4 treats <code>Email</code> and <code>email</code> as two completely different values, splitting one channel into two rows in your reports. The builder automatically lowercases everything and replaces spaces with hyphens as you type, so this mistake isn't possible there.</p>

                <h2>3. Never tag links on your own website</h2>
                <p>UTMs are only for links that live <b>somewhere else</b> - a social post, an email, a partner's site, an ad. Never put a UTM link in your own site's navigation, footer, or internal buttons - doing that overwrites a visitor's real original source the moment they click it, corrupting the very data you're trying to protect.</p>

                <h2>4. One link per placement, and reuse the same values every time</h2>
                <p>If you post the same article on Facebook and Instagram, generate two separate links - same Campaign Name, different Campaign Source (<code>facebook</code> vs <code>instagram</code>). This is exactly what lets you compare which platform actually sends people who convert, not just clicks.</p>

                <h2>5. Test it once before you post it everywhere</h2>
                <p>Paste your generated link into a private/incognito browser tab and confirm it opens the right page. A broken or mistyped link is the most common way campaign data quietly goes missing.</p>

                <h2>6. Sharing a UTM link publicly is completely normal - two things confirmed</h2>
                <ul>
                    <li><b>Social preview image:</b> yes, your article's preview image (and title/description) will still show up correctly when you share a UTM-tagged link - the extra tracking parameters don't change which page loads or what its content is, so the same social preview card renders exactly as it would without them.</li>
                    <li><b>Any risk of being penalized:</b> no - UTM parameters are a public, industry-standard convention that Google itself created, used by essentially every brand and marketer on every platform. Genuinely sharing a UTM link is not spam and carries no platform risk on its own.</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>