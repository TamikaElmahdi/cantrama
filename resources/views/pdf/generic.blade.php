<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"/>
<style>
@font-face {
    font-family: 'Amiri';
    src: url('{{ storage_path('fonts/Amiri-Regular.ttf') }}') format('truetype');
    font-weight: normal;
    font-style: normal;
}
@font-face {
    font-family: 'Amiri';
    src: url('{{ storage_path('fonts/Amiri-Bold.ttf') }}') format('truetype');
    font-weight: bold;
    font-style: normal;
}

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: 'DejaVu Serif', Georgia, serif;
    font-size: 10.5pt;
    color: #1a1a1a;
    line-height: 1.65;
}

.page {
    width: 210mm;
    min-height: 297mm;
    padding: 18mm 20mm 22mm 20mm;
    position: relative;
    background: #fff;
}

/* ── WATERMARK ── */
.watermark {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(-40deg);
    font-size: 40pt;
    color: rgba(0,0,0,0.06);
    white-space: nowrap;
    font-family: 'DejaVu Sans', Arial, sans-serif;
    pointer-events: none;
    z-index: 1000;
    font-weight: bold;
    letter-spacing: 4px;
}

/* ── HEADER ── */
.header {
    border-bottom: 3px solid #1a3a6b;
    padding-bottom: 12px;
    margin-bottom: 18px;
}
.header-top {
    display: table;
    width: 100%;
    margin-bottom: 6px;
}
.header-fr-col {
    display: table-cell;
    vertical-align: middle;
    width: 60%;
}
.header-ar-col {
    display: table-cell;
    vertical-align: middle;
    width: 40%;
    text-align: right;
}
.title-fr {
    font-size: 16pt;
    font-weight: bold;
    color: #1a3a6b;
    line-height: 1.2;
}
.title-ar {
    font-family: 'Amiri', serif;
    font-size: 14pt;
    font-weight: bold;
    color: #1a3a6b;
    direction: rtl;
    unicode-bidi: bidi-override;
    line-height: 1.4;
    text-align: right;
}
.header-meta {
    text-align: center;
    font-size: 8pt;
    color: #666;
    margin-top: 5px;
    font-style: italic;
}
.ref-line {
    display: table;
    width: 100%;
    margin-top: 6px;
}
.ref-left {
    display: table-cell;
    font-size: 8pt;
    color: #888;
}
.ref-right {
    display: table-cell;
    text-align: right;
    font-size: 8pt;
    color: #888;
}

/* ── SECTION ── */
.section {
    margin-bottom: 14px;
}
.section-title {
    font-size: 8.5pt;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.7px;
    color: #fff;
    background: #1a3a6b;
    padding: 4px 10px;
    margin-bottom: 10px;
    display: table;
    width: 100%;
}
.section-title-fr {
    display: table-cell;
    vertical-align: middle;
}
.section-title-ar {
    display: table-cell;
    text-align: right;
    font-family: 'Amiri', serif;
    font-size: 10pt;
    font-weight: normal;
    color: #b8cde8;
    direction: rtl;
    unicode-bidi: bidi-override;
    vertical-align: middle;
}

/* ── FIELDS TABLE ── */
.fields-table {
    width: 100%;
    border-collapse: collapse;
}
.fields-table tr {
    border-bottom: 1px solid #eef1f6;
}
.fields-table tr:last-child {
    border-bottom: none;
}
.field-label {
    width: 38%;
    padding: 5px 8px 5px 0;
    vertical-align: top;
    font-size: 9.5pt;
    color: #333;
    font-weight: bold;
}
.field-label-ar {
    font-family: 'Amiri', serif;
    font-size: 9.5pt;
    font-weight: normal;
    color: #999;
    direction: rtl;
    unicode-bidi: bidi-override;
    display: block;
    margin-top: 1px;
}
.field-value {
    width: 62%;
    padding: 5px 0 5px 10px;
    vertical-align: top;
    font-size: 10pt;
    color: #111;
    border-left: 2px solid #dde8f4;
    word-wrap: break-word;
    overflow-wrap: break-word;
}
.field-value-empty {
    color: #ccc;
    font-style: italic;
    font-size: 9pt;
}

/* ── TEXTAREA FIELD BOX ── */
.textarea-field {
    margin-bottom: 10px;
    border: 1px solid #dde4f0;
    border-left: 3px solid #1a3a6b;
    padding: 8px 10px;
    background: #fafbfe;
}
.textarea-label {
    display: table;
    width: 100%;
    margin-bottom: 4px;
}
.textarea-label-fr {
    display: table-cell;
    font-size: 9pt;
    font-weight: bold;
    color: #1a3a6b;
    vertical-align: middle;
}
.textarea-label-ar {
    display: table-cell;
    text-align: right;
    font-family: 'Amiri', serif;
    font-size: 9.5pt;
    font-weight: normal;
    color: #aaa;
    direction: rtl;
    unicode-bidi: bidi-override;
    vertical-align: middle;
}
.textarea-content {
    font-size: 9.5pt;
    color: #1a1a1a;
    line-height: 1.65;
    word-wrap: break-word;
    overflow-wrap: break-word;
    padding-top: 3px;
    border-top: 1px dashed #e0e8f4;
}

/* ── CLAUSES ── */
.clause {
    margin-bottom: 8px;
    font-size: 9.5pt;
    text-align: justify;
    word-wrap: break-word;
    overflow-wrap: break-word;
    padding-left: 2px;
}
.clause strong {
    color: #1a3a6b;
}

/* ── SIGNATURES ── */
.sig-section {
    margin-top: 18px;
}
.sig-date-line {
    font-size: 9.5pt;
    margin-bottom: 14px;
    color: #333;
}
.sig-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 10px 0;
}
.sig-table td {
    width: 50%;
    vertical-align: top;
    padding: 0;
}
.sig-box {
    border: 1px solid #ccd8ea;
    padding: 10px 12px;
    min-height: 85px;
    background: #fafbfe;
}
.sig-party-header {
    display: table;
    width: 100%;
    border-bottom: 1px solid #dde4f0;
    padding-bottom: 5px;
    margin-bottom: 7px;
}
.sig-party-fr {
    display: table-cell;
    font-size: 8pt;
    font-weight: bold;
    color: #1a3a6b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    vertical-align: middle;
}
.sig-party-ar {
    display: table-cell;
    text-align: right;
    font-family: 'Amiri', serif;
    font-size: 10pt;
    font-weight: bold;
    color: #4a6a9b;
    direction: rtl;
    unicode-bidi: bidi-override;
    vertical-align: middle;
}
.sig-party-name {
    font-size: 10pt;
    font-weight: bold;
    color: #222;
    margin-bottom: 4px;
}
.sig-hint {
    font-size: 8pt;
    color: #999;
    margin-top: 16px;
    font-style: italic;
}
.sig-line {
    border-bottom: 1px solid #aaa;
    margin-top: 6px;
    width: 80%;
}

/* ── FOOTER ── */
.footer {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 5px 20mm;
    border-top: 1px solid #dde4f0;
    background: #fff;
    display: table;
    width: 100%;
}
.footer-left {
    display: table-cell;
    font-size: 7.5pt;
    color: #bbb;
    vertical-align: middle;
    font-family: 'DejaVu Sans', sans-serif;
}
.footer-right {
    display: table-cell;
    text-align: right;
    font-size: 7.5pt;
    color: #bbb;
    vertical-align: middle;
    font-family: 'DejaVu Sans', sans-serif;
}
</style>
</head>
<body>
<div class="page">

@if($watermark ?? false)
<div class="watermark">ContratMA — Aperçu gratuit</div>
@endif

{{-- ══ HEADER ══ --}}
<div class="header">
    <div class="header-top">
        <div class="header-fr-col">
            <div class="title-fr">{{ $template->name_fr ?? 'Contrat' }}</div>
        </div>
        <div class="header-ar-col">
            <div class="title-ar">{{ $template->name_ar ?? '' }}</div>
        </div>
    </div>
    <div class="header-meta">
        Régi par la législation marocaine &mdash; Dahir des Obligations et des Contrats (D.O.C.)
    </div>
    <div class="ref-line">
        <div class="ref-left">Catégorie&nbsp;: {{ $template->category ?? '' }}</div>
        <div class="ref-right">
            Date&nbsp;:&nbsp;
            @if(!empty($data['date_signature']))
                {{ \Carbon\Carbon::parse($data['date_signature'])->format('d/m/Y') }}
            @else
                {{ date('d/m/Y') }}
            @endif
        </div>
    </div>
</div>

{{-- ══ PARSE FIELDS ══ --}}
@php
    $fields         = $template->fields ?? [];
    $regularFields  = [];
    $textareaFields = [];

    foreach ($fields as $field) {
        if ($field['type'] === 'textarea') {
            $textareaFields[] = $field;
        } else {
            $regularFields[] = $field;
        }
    }

    $party1 = $data['client_name']        ?? $data['employeur_name']    ?? $data['bailleur_name']
           ?? $data['vendeur_name']       ?? $data['partenaire_a_name'] ?? $data['partie_a_name']
           ?? $data['mandant_name']       ?? $data['debiteur_name']     ?? $data['salarie_name']
           ?? null;

    $party2 = $data['prestataire_name']   ?? $data['salarie_name']      ?? $data['locataire_name']
           ?? $data['acheteur_name']      ?? $data['partenaire_b_name'] ?? $data['partie_b_name']
           ?? $data['mandataire_name']    ?? $data['creancier_name']    ?? $data['gerant_name']
           ?? null;
@endphp

{{-- ══ REGULAR FIELDS ══ --}}
@if(count($regularFields) > 0)
<div class="section">
    <div class="section-title">
        <span class="section-title-fr">Informations du contrat</span>
        <span class="section-title-ar">معلومات العقد</span>
    </div>
    <table class="fields-table">
        @foreach($regularFields as $field)
        @php
            $val = $data[$field['name']] ?? null;
            $isMonetary = str_contains(strtolower($field['label_fr'] ?? ''), 'montant')
                       || str_contains(strtolower($field['label_fr'] ?? ''), 'salaire')
                       || str_contains(strtolower($field['label_fr'] ?? ''), 'loyer')
                       || str_contains(strtolower($field['label_fr'] ?? ''), 'prix')
                       || str_contains(strtolower($field['label_fr'] ?? ''), 'caution')
                       || str_contains(strtolower($field['label_fr'] ?? ''), 'avance')
                       || str_contains(strtolower($field['label_fr'] ?? ''), 'capital');
        @endphp
        <tr>
            <td class="field-label">
                {{ $field['label_fr'] ?? '' }}
                <span class="field-label-ar">{{ $field['label_ar'] ?? '' }}</span>
            </td>
            <td class="field-value @if(!$val) field-value-empty @endif">
                @if($val !== null && $val !== '')
                    @if($field['type'] === 'date')
                        {{ \Carbon\Carbon::parse($val)->format('d/m/Y') }}
                    @elseif($field['type'] === 'number' && $isMonetary)
                        {{ number_format((float)$val, 2, ',', '&nbsp;') }} {{ $data['devise'] ?? 'MAD' }}
                    @elseif($field['type'] === 'number')
                        {{ number_format((float)$val, 0, ',', '&nbsp;') }}
                    @else
                        {{ $val }}
                    @endif
                @else
                    non renseigné
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endif

{{-- ══ TEXTAREA FIELDS ══ --}}
@if(count($textareaFields) > 0)
<div class="section">
    <div class="section-title">
        <span class="section-title-fr">Détails et descriptions</span>
        <span class="section-title-ar">التفاصيل والأوصاف</span>
    </div>
    @foreach($textareaFields as $field)
    @php $val = $data[$field['name']] ?? null; @endphp
    <div class="textarea-field">
        <div class="textarea-label">
            <div class="textarea-label-fr">{{ $field['label_fr'] ?? '' }}</div>
            <div class="textarea-label-ar">{{ $field['label_ar'] ?? '' }}</div>
        </div>
        <div class="textarea-content">
            @if($val !== null && $val !== '')
                {!! nl2br(e($val)) !!}
            @else
                <span style="color:#ccc; font-style:italic;">non renseigné</span>
            @endif
        </div>
    </div>
    @endforeach
</div>
@endif

{{-- ══ CLAUSES GÉNÉRALES ══ --}}
<div class="section">
    <div class="section-title">
        <span class="section-title-fr">Clauses générales</span>
        <span class="section-title-ar">الشروط العامة</span>
    </div>

    <p class="clause">
        <strong>Art. 1 — Bonne foi :</strong>
        Les parties s'engagent à exécuter le présent contrat de bonne foi et avec loyauté, conformément aux dispositions du Dahir des Obligations et des Contrats (D.O.C.) marocain.
    </p>
    <p class="clause">
        <strong>Art. 2 — Confidentialité :</strong>
        Les parties s'engagent à garder confidentielles toutes les informations échangées dans le cadre de la présente relation contractuelle et à ne pas les divulguer à des tiers sans accord préalable écrit.
    </p>
    <p class="clause">
        <strong>Art. 3 — Résolution des litiges :</strong>
        En cas de différend, les parties s'efforceront de trouver une solution amiable dans un délai de 30 jours. À défaut, le tribunal compétent de
        <strong>{{ $data['ville'] ?? 'Casablanca' }}</strong>
        sera seul compétent pour trancher le litige, conformément à la loi marocaine.
    </p>
    <p class="clause">
        <strong>Art. 4 — Droit applicable :</strong>
        Le présent contrat est soumis exclusivement au droit marocain en vigueur, notamment aux dispositions du D.O.C. et des lois spéciales applicables.
    </p>
    <p class="clause">
        <strong>Art. 5 — Nullité partielle :</strong>
        Si l'une quelconque des clauses est déclarée nulle ou inapplicable, les autres clauses conserveront leur plein effet entre les parties.
    </p>
</div>

{{-- ══ SIGNATURES ══ --}}
<div class="sig-section">
    <div class="section-title">
        <span class="section-title-fr">Signatures des parties</span>
        <span class="section-title-ar">توقيعات الأطراف</span>
    </div>

    @php
        $ville    = $data['ville'] ?? '___________';
        $dateSign = !empty($data['date_signature'])
                    ? \Carbon\Carbon::parse($data['date_signature'])->format('d/m/Y')
                    : '___________';
    @endphp

    <p class="sig-date-line">
        Fait à <strong>{{ $ville }}</strong>, le <strong>{{ $dateSign }}</strong>,
        en deux (2) exemplaires originaux ayant chacun même valeur juridique.
    </p>

    <table class="sig-table">
        <tr>
            <td>
                <div class="sig-box">
                    <div class="sig-party-header">
                        <span class="sig-party-fr">Partie 1</span>
                        <span class="sig-party-ar">الطرف الأول</span>
                    </div>
                    @if($party1)
                    <div class="sig-party-name">{{ $party1 }}</div>
                    @else
                    <div class="sig-party-name" style="color:#bbb; font-weight:normal; font-style:italic; font-size:9pt;">— À compléter —</div>
                    @endif
                    <div class="sig-hint">Lu et approuvé &mdash; Signature et cachet :</div>
                    <div class="sig-line"></div>
                </div>
            </td>
            <td>
                <div class="sig-box">
                    <div class="sig-party-header">
                        <span class="sig-party-fr">Partie 2</span>
                        <span class="sig-party-ar">الطرف الثاني</span>
                    </div>
                    @if($party2)
                    <div class="sig-party-name">{{ $party2 }}</div>
                    @else
                    <div class="sig-party-name" style="color:#bbb; font-weight:normal; font-style:italic; font-size:9pt;">— À compléter —</div>
                    @endif
                    <div class="sig-hint">Lu et approuvé &mdash; Signature et cachet :</div>
                    <div class="sig-line"></div>
                </div>
            </td>
        </tr>
    </table>
</div>

{{-- ══ FOOTER ══ --}}
<div class="footer">
    <div class="footer-left">ContratMA.com &mdash; Contrats professionnels pour le marché marocain</div>
    <div class="footer-right">Conforme au droit marocain &mdash; D.O.C. &amp; législation en vigueur</div>
</div>

</div>
</body>
</html>
