<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UTM Builder</title>
    <style>
        *,::after,::before{box-sizing:border-box;margin:0;padding:0}

        html,body{height:100%;overflow:hidden}
        body{
            font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Arial,Helvetica,sans-serif;
            background-color:#F2F5F1;color:#16231D;line-height:1.5;
            display:flex;flex-direction:column;
        }

        .app-header{
            flex-shrink:0;display:flex;align-items:center;justify-content:space-between;
            gap:1rem;flex-wrap:nowrap;
            padding:0.85rem 1.75rem;background-color:#fff;border-bottom:1px solid #DCE3DC;
        }
        .app-name{font-size:1.05rem;font-weight:700;color:#1F4B3F;text-decoration:none;letter-spacing:-0.01em;white-space:nowrap;flex-shrink:0}
        .header-link{
            flex-shrink:0;display:inline-flex;align-items:center;gap:0.35rem;font-size:0.85rem;font-weight:700;
            color:#1F4B3F;text-decoration:none;border:1px solid #C9D3C8;border-radius:999px;
            padding:0.45rem 1.05rem;transition:background-color .15s ease;white-space:nowrap;
        }
        .header-link:hover{background-color:#EEF1EC}

        .main{
            flex:1;min-height:0;overflow:hidden;
            display:flex;align-items:center;justify-content:center;
            padding:1.5rem 3rem;
        }

        .wrap{width:100%;max-width:88rem}
        .lede{color:#5C6B60;font-size:0.88rem;margin-bottom:1.1rem}

        /* 2 columns: form on the left, result on the right - this is
           what actually fixes the space problem, not just smaller
           fonts. Stacked, the result card added its own full height on
           top of the form's; side by side, the page only ever needs to
           be as tall as the form column, which is the taller of the
           two. */
        .layout{display:grid;grid-template-columns:1.3fr 1fr;gap:1.5rem;align-items:start;min-width:0}
        .layout > div{min-width:0}

        .card{
            background-color:#fff;border:1px solid #DCE3DC;border-radius:14px;
            padding:1.5rem;box-shadow:0 1px 3px rgba(20,32,26,0.05);
        }

        .form-grid{display:grid;grid-template-columns:1fr 1fr;column-gap:1.1rem;row-gap:1rem}
        .field{min-width:0}
        .field-full{grid-column:1 / -1}

        label{display:block;font-weight:600;font-size:0.82rem;color:#16231D}
        .req{color:#C6491D;font-weight:700}
        .opt{color:#8A9B90;font-weight:400;font-size:0.72rem}
        .help{margin-top:0.25rem;font-size:0.72rem;color:#5C6B60;line-height:1.4}
        .help b{color:#1F4B3F}

        input[type=text], input[type=url], select {
            margin-top:0.35rem;width:100%;min-width:0;padding:0.55rem 0.7rem;
            border:1px solid #C9D3C8;border-radius:8px;font-size:0.87rem;
            font-family:inherit;color:#16231D;background-color:#fff;
        }
        input:focus, select:focus{outline:none;border-color:#1F4B3F;box-shadow:0 0 0 3px rgba(31,75,63,0.14)}
        .err{border-color:#C6491D !important}
        .err-msg{margin-top:0.25rem;font-size:0.72rem;color:#C6491D;display:none}

        .result-card{
            background-color:#1F4B3F;border-radius:14px;padding:1.5rem;
            box-shadow:0 1px 3px rgba(20,32,26,0.08);
        }
        .result-label{color:rgba(242,245,241,0.65);font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.05em}
        .result-box{
            margin-top:0.6rem;background-color:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.2);
            border-radius:8px;padding:0.8rem 0.9rem;color:#fff;font-family:'Courier New',monospace;
            font-size:0.8rem;word-break:break-all;overflow-wrap:anywhere;min-height:4.5em;
        }
        .result-placeholder{color:rgba(255,255,255,0.4);font-style:italic}

        .copy-row{margin-top:0.9rem;display:flex;align-items:center;gap:0.75rem;flex-wrap:wrap}
        .copy-btn{
            display:inline-flex;align-items:center;gap:0.45rem;background-color:#C6491D;color:#fff;
            border:none;border-radius:999px;padding:0.6rem 1.35rem;font-size:0.86rem;font-weight:700;
            cursor:pointer;font-family:inherit;transition:background-color .15s ease;
        }
        .copy-btn:hover:not(:disabled){background-color:#a83c17}
        .copy-btn:disabled{opacity:0.45;cursor:not-allowed}
        .copied-note{color:#F2F5F1;font-size:0.82rem;font-weight:600;opacity:0;transition:opacity .15s ease}
        .copied-note.show{opacity:1}

        .reset-btn{
            background:none;border:1px solid #C9D3C8;border-radius:999px;color:#5C6B60;
            font-size:0.78rem;font-weight:600;padding:0.4rem 1rem;cursor:pointer;font-family:inherit;
            transition:background-color .15s ease,color .15s ease;
        }
        .reset-btn:hover{background-color:#EEF1EC;color:#1F4B3F}

        @media (max-width:760px){
            .layout{grid-template-columns:1fr}
        }
    </style>
</head>
<body>
    <div class="app-header">
        <a href="/" class="app-name">UTM Builder</a>
        <a href="/guide" class="header-link">How to use this &rarr;</a>
    </div>

    <div class="main">
        <div class="wrap">
            <p class="lede">Build a correctly-tagged link so Google Analytics shows exactly which channel sent the traffic.</p>

            <div class="layout">
                <div class="card">
                    <div class="form-grid">
                        <div class="field field-full">
                            <label for="url">Website URL <span class="req">*</span></label>
                            <input type="url" id="url" placeholder="https://publishfit.com/blog/your-article">
                            <p class="help">The exact page you're linking to. Must start with <b>https://</b>.</p>
                            <p class="err-msg" id="url-err">Please enter a full URL starting with https://</p>
                        </div>

                        <div class="field">
                            <label for="source">Campaign Source <span class="req">*</span></label>
                            <input type="text" id="source" list="source-suggestions" placeholder="facebook">
                            <datalist id="source-suggestions">
                                <option value="facebook">
                                <option value="instagram">
                                <option value="x">
                                <option value="linkedin">
                                <option value="pinterest">
                                <option value="youtube">
                                <option value="tiktok">
                                <option value="reddit">
                                <option value="quora">
                                <option value="whatsapp">
                                <option value="telegram">
                                <option value="newsletter">
                                <option value="google">
                                <option value="bing">
                                <option value="medium">
                                <option value="substack">
                                <option value="producthunt">
                                <option value="partner-name">
                            </datalist>
                            <p class="help"><b>Where</b> the click comes from. Pick a suggestion or type your own.</p>
                            <p class="err-msg" id="source-err">Campaign Source is required.</p>
                        </div>

                        <div class="field">
                            <label for="medium">Campaign Medium <span class="req">*</span></label>
                            <select id="medium">
                                <option value="">Select channel type...</option>
                                <option value="social">Social - organic post</option>
                                <option value="cpc">Paid Ad - Google/Meta Ads</option>
                                <option value="email">Email - newsletter/campaign</option>
                                <option value="affiliate">Affiliate - partner referral</option>
                                <option value="referral">Referral - another website</option>
                                <option value="display">Display - banner ad</option>
                                <option value="sms">SMS - text message</option>
                                <option value="push">Push - push notification</option>
                            </select>
                            <p class="help">The field that fixes "everything shows as Direct."</p>
                            <p class="err-msg" id="medium-err">Campaign Medium is required.</p>
                        </div>

                        <div class="field">
                            <label for="campaign">Campaign Name <span class="req">*</span></label>
                            <input type="text" id="campaign" placeholder="spring-launch-2026">
                            <p class="help"><b>Which push</b> this belongs to - groups it all together.</p>
                            <p class="err-msg" id="campaign-err">Campaign Name is required.</p>
                        </div>

                        <div class="field">
                            <label for="content">Campaign Content <span class="opt">(optional)</span></label>
                            <input type="text" id="content" placeholder="bio-link">
                            <p class="help">Only if two links point to the same place.</p>
                        </div>

                        <div class="field">
                            <label for="term">Campaign Term <span class="opt">(optional)</span></label>
                            <input type="text" id="term" placeholder="content-scoring-tool">
                            <p class="help">Only for paid search keywords (Google Ads).</p>
                        </div>
                    <div class="field field-full" style="text-align:right;margin-top:0.3rem;">
                        <button type="button" class="reset-btn" id="reset-btn">Reset Form</button>
                    </div>
                    </div>
                </div>

                <div class="result-card">
                    <div class="result-label">Your UTM Link</div>
                    <div class="result-box" id="result"><span class="result-placeholder">Fill in the required fields to generate your link...</span></div>
                    <div class="copy-row">
                        <button type="button" class="copy-btn" id="copy-btn" disabled>Copy Link</button>
                        <span class="copied-note" id="copied-note">Copied!</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const urlInput = document.getElementById('url');
            const sourceInput = document.getElementById('source');
            const mediumSelect = document.getElementById('medium');
            const campaignInput = document.getElementById('campaign');
            const contentInput = document.getElementById('content');
            const termInput = document.getElementById('term');
            const resultBox = document.getElementById('result');
            const copyBtn = document.getElementById('copy-btn');
            const copiedNote = document.getElementById('copied-note');
            const resetBtn = document.getElementById('reset-btn');

            function slugify(value) {
                return value
                    .toLowerCase()
                    .trim()
                    .replace(/\s+/g, '-')
                    .replace(/[^a-z0-9\-_.]/g, '');
            }

            function attachSlugify(input) {
                input.addEventListener('input', () => {
                    const cursor = input.selectionStart;
                    const before = input.value;
                    input.value = slugify(input.value);
                    const diff = before.length - input.value.length;
                    input.setSelectionRange(Math.max(0, cursor - diff), Math.max(0, cursor - diff));
                });
            }

            [sourceInput, campaignInput, contentInput, termInput].forEach(attachSlugify);

            function isValidUrl(value) {
                try {
                    const parsed = new URL(value);
                    return parsed.protocol === 'http:' || parsed.protocol === 'https:';
                } catch (e) {
                    return false;
                }
            }

            function setError(input, errEl, show) {
                input.classList.toggle('err', show);
                errEl.style.display = show ? 'block' : 'none';
            }

            function build() {
                const url = urlInput.value.trim();
                const source = sourceInput.value.trim();
                const medium = mediumSelect.value.trim();
                const campaign = campaignInput.value.trim();
                const content = contentInput.value.trim();
                const term = termInput.value.trim();

                const urlOk = url === '' || isValidUrl(url);
                setError(urlInput, document.getElementById('url-err'), url !== '' && !urlOk);

                const requiredFilled = url !== '' && urlOk && source !== '' && medium !== '' && campaign !== '';

                if (!requiredFilled) {
                    resultBox.innerHTML = '<span class="result-placeholder">Fill in the required fields to generate your link...</span>';
                    copyBtn.disabled = true;
                    return;
                }

                const params = new URLSearchParams();
                params.set('utm_source', source);
                params.set('utm_medium', medium);
                params.set('utm_campaign', campaign);
                if (content) params.set('utm_content', content);
                if (term) params.set('utm_term', term);

                const separator = url.includes('?') ? '&' : '?';
                const finalUrl = url + separator + params.toString();

                resultBox.textContent = finalUrl;
                copyBtn.disabled = false;
                copyBtn.dataset.url = finalUrl;
            }

            [urlInput, sourceInput, mediumSelect, campaignInput, contentInput, termInput].forEach((el) => {
                el.addEventListener('input', build);
                el.addEventListener('change', build);
            });

            copyBtn.addEventListener('click', () => {
                const value = copyBtn.dataset.url;
                if (!value) return;

                navigator.clipboard.writeText(value).then(() => {
                    copiedNote.classList.add('show');
                    setTimeout(() => copiedNote.classList.remove('show'), 1800);
                });
            });

            resetBtn.addEventListener('click', () => {
                [urlInput, sourceInput, campaignInput, contentInput, termInput].forEach((el) => el.value = '');
                mediumSelect.value = '';
                setError(urlInput, document.getElementById('url-err'), false);
                build();
            });
        })();
    </script>
</body>
</html>