<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 11pt;
        color: #1a1a1a;
        line-height: 1.6;
    }
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm 18mm;
        position: relative;
    }
    .watermark {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-45deg);
        font-size: 36pt;
        color: rgba(180, 180, 180, 0.25);
        white-space: nowrap;
        font-family: Arial, sans-serif;
        pointer-events: none;
        z-index: 1000;
    }
    .header-table {
        width: 100%;
        border-bottom: 2px solid #1a1a1a;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
    .header-fr {
        font-size: 14pt;
        font-weight: bold;
        text-align: left;
    }
    .header-ar {
        font-size: 13pt;
        font-weight: bold;
        text-align: right;
        direction: rtl;
    }
    .header-subtitle {
        text-align: center;
        font-size: 9pt;
        color: #555;
        margin-top: 5px;
    }
    .section {
        margin-bottom: 18px;
    }
    .section-title {
        font-size: 10pt;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #999;
        padding-bottom: 3px;
        margin-bottom: 10px;
    }
    .row-table {
        width: 100%;
    }
    .row-table td {
        padding: 3px 0;
        vertical-align: top;
    }
    .label {
        font-weight: bold;
        width: 45%;
        font-size: 10pt;
    }
    .value {
        width: 55%;
        font-size: 10pt;
    }
    .objet-box {
        border: 1px solid #ccc;
        padding: 10px;
        font-size: 10pt;
        min-height: 60px;
    }
    .clause {
        margin-bottom: 10px;
        font-size: 10pt;
    }
    .clause-title {
        font-weight: bold;
    }
    .sig-table {
        width: 100%;
        margin-top: 30px;
    }
    .sig-table td {
        width: 50%;
        vertical-align: top;
        padding: 0 10px;
    }
    .sig-block {
        border-top: 1px solid #555;
        padding-top: 8px;
        font-size: 10pt;
        min-height: 60px;
    }
    .sig-name {
        font-weight: bold;
    }
    .footer {
        margin-top: 30px;
        font-size: 8pt;
        color: #777;
        text-align: center;
        border-top: 1px solid #ccc;
        padding-top: 5px;
    }
</style>
</head>
<body>
<div class="page">

    @if($watermark ?? false)
    <div class="watermark">ContratMA.com — Version gratuite</div>
    @endif

    {{-- Header --}}
    <table class="header-table">
        <tr>
            <td class="header-fr">Accord de Confidentialité (NDA)</td>
            <td class="header-ar">اتفاقية السرية وعدم الإفصاح</td>
        </tr>
    </table>
    <p class="header-subtitle">Non-Disclosure Agreement — Régi par le droit marocain (D.O.C.)</p>

    <br>

    {{-- Parties --}}
    <div class="section">
        <div class="section-title">Article 1 — Les Parties / الأطراف</div>
        <p style="font-weight:bold; font-size:10pt;">Partie A (Divulgante) :</p>
        <table class="row-table">
            <tr>
                <td class="label">Nom / Raison sociale :</td>
                <td class="value">{{ $data['partie_a_name'] ?? '' }}</td>
            </tr>
            <tr>
                <td class="label">Adresse :</td>
                <td class="value">{{ $data['partie_a_address'] ?? '' }}</td>
            </tr>
        </table>

        <br>
        <p style="font-weight:bold; font-size:10pt;">Partie B (Réceptrice) :</p>
        <table class="row-table">
            <tr>
                <td class="label">Nom / Raison sociale :</td>
                <td class="value">{{ $data['partie_b_name'] ?? '' }}</td>
            </tr>
            <tr>
                <td class="label">Adresse :</td>
                <td class="value">{{ $data['partie_b_address'] ?? '' }}</td>
            </tr>
        </table>

        <br>
        <p style="font-size:10pt;">Les deux parties, désignées collectivement « les Parties », conviennent des conditions de confidentialité suivantes.</p>
    </div>

    {{-- Objet --}}
    <div class="section">
        <div class="section-title">Article 2 — Objet de la Confidentialité / موضوع السرية</div>
        <p style="font-size:10pt; margin-bottom:6px;">Les informations confidentielles visées par le présent accord sont :</p>
        <div class="objet-box">{{ $data['objet_confidentialite'] ?? '' }}</div>
    </div>

    {{-- Obligations --}}
    <div class="section">
        <div class="section-title">Article 3 — Obligations de Confidentialité / التزامات السرية</div>

        <div class="clause">
            <span class="clause-title">3.1 Non-divulgation :</span>
            La Partie B s'engage à ne divulguer à aucun tiers, sous quelque forme que ce soit, les informations confidentielles reçues de la Partie A, pendant toute la durée du présent accord et après son expiration.
        </div>

        <div class="clause">
            <span class="clause-title">3.2 Usage limité :</span>
            Les informations confidentielles ne seront utilisées par la Partie B qu'aux seules fins pour lesquelles elles ont été communiquées. Toute utilisation à d'autres fins est strictement interdite sans accord écrit préalable de la Partie A.
        </div>

        <div class="clause">
            <span class="clause-title">3.3 Mesures de protection :</span>
            La Partie B s'engage à mettre en place toutes les mesures raisonnables pour protéger les informations confidentielles contre tout accès non autorisé, divulgation ou utilisation abusive.
        </div>
    </div>

    {{-- Durée --}}
    <div class="section">
        <div class="section-title">Article 4 — Durée / المدة</div>
        <p style="font-size:10pt;">Le présent accord prend effet à la date de signature et reste en vigueur pour une durée de <strong>{{ $data['duree_annees'] ?? '' }} an(s)</strong> à compter de ladite date. À l'expiration de ce délai, les obligations de confidentialité demeurent applicables pour les informations de nature commerciale et industrielle sensible.</p>
    </div>

    {{-- Exceptions --}}
    <div class="section">
        <div class="section-title">Article 5 — Exceptions / الاستثناءات</div>
        <p style="font-size:10pt;">Les obligations de confidentialité ne s'appliquent pas aux informations qui : (i) sont ou deviennent publiquement disponibles sans faute de la Partie B ; (ii) étaient déjà connues de la Partie B avant leur divulgation ; (iii) ont été légalement obtenues d'un tiers sans restriction ; (iv) doivent être divulguées en vertu d'une obligation légale ou réglementaire.</p>
    </div>

    {{-- Sanctions --}}
    <div class="section">
        <div class="section-title">Article 6 — Responsabilité et Sanctions / المسؤولية والجزاءات</div>
        <p style="font-size:10pt;">Tout manquement aux obligations du présent accord engage la responsabilité civile de la partie défaillante. La partie lésée est en droit de réclamer réparation de l'intégralité du préjudice subi, conformément aux dispositions du D.O.C. marocain.</p>
    </div>

    {{-- Loi --}}
    <div class="section">
        <div class="section-title">Article 7 — Loi Applicable / القانون المطبق</div>
        <p style="font-size:10pt;">Le présent accord est régi par le droit marocain. Tout litige sera soumis à la juridiction exclusive du Tribunal compétent de <strong>{{ $data['ville'] ?? '' }}</strong>.</p>
    </div>

    {{-- Signatures --}}
    <div class="section">
        <div class="section-title">Signatures / التوقيعات</div>
        <p style="font-size:10pt;">Fait à <strong>{{ $data['ville'] ?? '' }}</strong>, le <strong>{{ $data['date_signature'] ?? '' }}</strong>, en deux (2) exemplaires originaux.</p>

        <table class="sig-table">
            <tr>
                <td>
                    <div class="sig-block">
                        <div class="sig-name">Partie A — الطرف الأول</div>
                        <div>{{ $data['partie_a_name'] ?? '' }}</div>
                        <br><br>
                        <div>Signature et cachet :</div>
                    </div>
                </td>
                <td>
                    <div class="sig-block" style="text-align:right; direction:rtl;">
                        <div class="sig-name">الطرف الثاني — Partie B</div>
                        <div>{{ $data['partie_b_name'] ?? '' }}</div>
                        <br><br>
                        <div>التوقيع والختم :</div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        Généré par ContratMA.com — Contrats professionnels pour le marché marocain
    </div>

</div>
</body>
</html>
