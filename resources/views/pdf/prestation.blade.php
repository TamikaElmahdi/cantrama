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
    /* Watermark */
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
    /* Header bilingual */
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
    /* Sections */
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
    .service-box {
        border: 1px solid #ccc;
        padding: 10px;
        font-size: 10pt;
        min-height: 60px;
    }
    /* Clauses */
    .clause {
        margin-bottom: 10px;
        font-size: 10pt;
    }
    .clause-title {
        font-weight: bold;
    }
    /* Signatures */
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
            <td class="header-fr">Contrat de Prestation de Services</td>
            <td class="header-ar">عقد تقديم الخدمات</td>
        </tr>
    </table>
    <p class="header-subtitle">Régi par la législation marocaine — Droit des obligations et des contrats (D.O.C.)</p>

    <br>

    {{-- Parties --}}
    <div class="section">
        <div class="section-title">Article 1 — Les Parties / الأطراف</div>
        <p style="font-weight:bold; font-size:10pt;">Le Client :</p>
        <table class="row-table">
            <tr>
                <td class="label">Nom / Raison sociale :</td>
                <td class="value">{{ $data['client_name'] ?? '' }}</td>
            </tr>
            <tr>
                <td class="label">Adresse :</td>
                <td class="value">{{ $data['client_address'] ?? '' }}</td>
            </tr>
            @if(!empty($data['client_ice']))
            <tr>
                <td class="label">ICE :</td>
                <td class="value">{{ $data['client_ice'] }}</td>
            </tr>
            @endif
        </table>

        <br>
        <p style="font-weight:bold; font-size:10pt;">Le Prestataire :</p>
        <table class="row-table">
            <tr>
                <td class="label">Nom / Raison sociale :</td>
                <td class="value">{{ $data['prestataire_name'] ?? '' }}</td>
            </tr>
            <tr>
                <td class="label">Adresse :</td>
                <td class="value">{{ $data['prestataire_address'] ?? '' }}</td>
            </tr>
            @if(!empty($data['prestataire_ice']))
            <tr>
                <td class="label">ICE :</td>
                <td class="value">{{ $data['prestataire_ice'] }}</td>
            </tr>
            @endif
        </table>
    </div>

    {{-- Objet --}}
    <div class="section">
        <div class="section-title">Article 2 — Objet de la Mission / موضوع المهمة</div>
        <p style="font-size:10pt; margin-bottom:6px;">Le Client confie au Prestataire la réalisation de la mission suivante :</p>
        <div class="service-box">{{ $data['service_description'] ?? '' }}</div>
    </div>

    {{-- Montant --}}
    <div class="section">
        <div class="section-title">Article 3 — Montant et Modalités / المبلغ وشروط الدفع</div>
        <table class="row-table">
            <tr>
                <td class="label">Montant total convenu :</td>
                <td class="value"><strong>{{ $data['montant'] ?? '' }} {{ $data['devise'] ?? 'MAD' }}</strong></td>
            </tr>
        </table>
        <p style="font-size:10pt; margin-top:6px;">Le règlement sera effectué selon les modalités convenues entre les parties. Tout retard de paiement entraînera des pénalités conformément aux dispositions légales en vigueur au Maroc.</p>
    </div>

    {{-- Durée --}}
    <div class="section">
        <div class="section-title">Article 4 — Durée / المدة</div>
        <table class="row-table">
            <tr>
                <td class="label">Date de début :</td>
                <td class="value">{{ $data['date_debut'] ?? '' }}</td>
            </tr>
            <tr>
                <td class="label">Date de fin prévue :</td>
                <td class="value">{{ $data['date_fin'] ?? '' }}</td>
            </tr>
        </table>
    </div>

    {{-- Clauses --}}
    <div class="section">
        <div class="section-title">Article 5 — Clauses Générales / الشروط العامة</div>

        <div class="clause">
            <span class="clause-title">5.1 Confidentialité :</span>
            Le Prestataire s'engage à maintenir la confidentialité de toutes les informations reçues dans le cadre de ce contrat et à ne pas les divulguer à des tiers sans accord préalable écrit du Client.
        </div>

        <div class="clause">
            <span class="clause-title">5.2 Propriété intellectuelle :</span>
            Les livrables produits dans le cadre de cette mission seront la propriété exclusive du Client dès règlement intégral des honoraires convenus. Le Prestataire conserve le droit de mention à titre de référence, sauf accord contraire.
        </div>

        <div class="clause">
            <span class="clause-title">5.3 Résiliation :</span>
            Chaque partie peut résilier le présent contrat moyennant un préavis écrit de 15 (quinze) jours. En cas de résiliation anticipée par le Client, les prestations déjà réalisées seront dues au Prestataire au prorata du travail effectué.
        </div>
    </div>

    {{-- Loi applicable --}}
    <div class="section">
        <div class="section-title">Article 6 — Loi Applicable et Juridiction / القانون المطبق والاختصاص القضائي</div>
        <p style="font-size:10pt;">Le présent contrat est régi par le droit marocain, notamment le Dahir des Obligations et des Contrats (D.O.C.). En cas de litige, les parties s'efforceront de trouver une solution amiable. À défaut, le Tribunal compétent de <strong>{{ $data['ville'] ?? '' }}</strong> sera seul compétent.</p>
    </div>

    {{-- Signatures --}}
    <div class="section">
        <div class="section-title">Signatures / التوقيعات</div>
        <p style="font-size:10pt;">Fait à <strong>{{ $data['ville'] ?? '' }}</strong>, le <strong>{{ $data['date_signature'] ?? '' }}</strong>, en deux (2) exemplaires originaux.</p>

        <table class="sig-table">
            <tr>
                <td>
                    <div class="sig-block">
                        <div class="sig-name">Le Client</div>
                        <div>{{ $data['client_name'] ?? '' }}</div>
                        <br><br>
                        <div>Signature et cachet :</div>
                    </div>
                </td>
                <td>
                    <div class="sig-block" style="text-align:right; direction:rtl;">
                        <div class="sig-name">المقدم للخدمة</div>
                        <div>{{ $data['prestataire_name'] ?? '' }}</div>
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
