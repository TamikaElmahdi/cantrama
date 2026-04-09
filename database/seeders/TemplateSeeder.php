<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            // ─── COMMERCIAL ───────────────────────────────────────────
            [
                'slug' => 'prestation-services',
                'name_fr' => 'Contrat de prestation de services',
                'name_ar' => 'عقد تقديم الخدمات',
                'category' => 'Commercial',
                'description_fr' => 'Encadre une mission ponctuelle entre un client et un prestataire indépendant.',
                'pdf_blade_path' => 'pdf.prestation',
                'fields' => [
                    ['name' => 'client_name', 'label_fr' => 'Nom du client', 'label_ar' => 'اسم العميل', 'type' => 'text', 'required' => true],
                    ['name' => 'client_address', 'label_fr' => 'Adresse du client', 'label_ar' => 'عنوان العميل', 'type' => 'text', 'required' => true],
                    ['name' => 'client_ice', 'label_fr' => 'ICE du client', 'label_ar' => 'رقم ICE العميل', 'type' => 'text', 'required' => false],
                    ['name' => 'prestataire_name', 'label_fr' => 'Nom du prestataire', 'label_ar' => 'اسم مزود الخدمة', 'type' => 'text', 'required' => true],
                    ['name' => 'prestataire_address', 'label_fr' => 'Adresse du prestataire', 'label_ar' => 'عنوان مزود الخدمة', 'type' => 'text', 'required' => true],
                    ['name' => 'prestataire_ice', 'label_fr' => 'ICE du prestataire', 'label_ar' => 'رقم ICE مزود الخدمة', 'type' => 'text', 'required' => false],
                    ['name' => 'service_description', 'label_fr' => 'Description de la mission', 'label_ar' => 'وصف المهمة', 'type' => 'textarea', 'required' => true],
                    ['name' => 'montant', 'label_fr' => 'Montant', 'label_ar' => 'المبلغ', 'type' => 'number', 'required' => true],
                    ['name' => 'devise', 'label_fr' => 'Devise', 'label_ar' => 'العملة', 'type' => 'select', 'options' => ['MAD', 'EUR', 'USD'], 'required' => true],
                    ['name' => 'date_debut', 'label_fr' => 'Date de début', 'label_ar' => 'تاريخ البداية', 'type' => 'date', 'required' => true],
                    ['name' => 'date_fin', 'label_fr' => 'Date de fin', 'label_ar' => 'تاريخ النهاية', 'type' => 'date', 'required' => true],
                    ['name' => 'ville', 'label_fr' => 'Ville', 'label_ar' => 'المدينة', 'type' => 'text', 'required' => true],
                    ['name' => 'date_signature', 'label_fr' => 'Date de signature', 'label_ar' => 'تاريخ التوقيع', 'type' => 'date', 'required' => true],
                ],
            ],
            [
                'slug' => 'accord-confidentialite',
                'name_fr' => 'Accord de confidentialité (NDA)',
                'name_ar' => 'اتفاقية السرية',
                'category' => 'Commercial',
                'description_fr' => 'Protège les informations échangées entre deux parties dans le cadre d\'une collaboration.',
                'pdf_blade_path' => 'pdf.nda',
                'fields' => [
                    ['name' => 'partie_a_name', 'label_fr' => 'Nom de la Partie A', 'label_ar' => 'اسم الطرف الأول', 'type' => 'text', 'required' => true],
                    ['name' => 'partie_a_address', 'label_fr' => 'Adresse de la Partie A', 'label_ar' => 'عنوان الطرف الأول', 'type' => 'text', 'required' => true],
                    ['name' => 'partie_b_name', 'label_fr' => 'Nom de la Partie B', 'label_ar' => 'اسم الطرف الثاني', 'type' => 'text', 'required' => true],
                    ['name' => 'partie_b_address', 'label_fr' => 'Adresse de la Partie B', 'label_ar' => 'عنوان الطرف الثاني', 'type' => 'text', 'required' => true],
                    ['name' => 'objet_confidentialite', 'label_fr' => 'Objet de la confidentialité', 'label_ar' => 'موضوع السرية', 'type' => 'textarea', 'required' => true],
                    ['name' => 'duree_annees', 'label_fr' => 'Durée (années)', 'label_ar' => 'المدة (سنوات)', 'type' => 'number', 'required' => true],
                    ['name' => 'ville', 'label_fr' => 'Ville', 'label_ar' => 'المدينة', 'type' => 'text', 'required' => true],
                    ['name' => 'date_signature', 'label_fr' => 'Date de signature', 'label_ar' => 'تاريخ التوقيع', 'type' => 'date', 'required' => true],
                ],
            ],
            [
                'slug' => 'contrat-partenariat',
                'name_fr' => 'Contrat de partenariat commercial',
                'name_ar' => 'عقد الشراكة التجارية',
                'category' => 'Commercial',
                'description_fr' => 'Formalise une collaboration commerciale entre deux entreprises ou indépendants.',
                'pdf_blade_path' => 'pdf.generic',
                'fields' => [
                    ['name' => 'partenaire_a_name', 'label_fr' => 'Partenaire A — Nom', 'label_ar' => 'الشريك الأول — الاسم', 'type' => 'text', 'required' => true],
                    ['name' => 'partenaire_a_address', 'label_fr' => 'Partenaire A — Adresse', 'label_ar' => 'الشريك الأول — العنوان', 'type' => 'text', 'required' => true],
                    ['name' => 'partenaire_a_ice', 'label_fr' => 'Partenaire A — ICE', 'label_ar' => 'الشريك الأول — ICE', 'type' => 'text', 'required' => false],
                    ['name' => 'partenaire_b_name', 'label_fr' => 'Partenaire B — Nom', 'label_ar' => 'الشريك الثاني — الاسم', 'type' => 'text', 'required' => true],
                    ['name' => 'partenaire_b_address', 'label_fr' => 'Partenaire B — Adresse', 'label_ar' => 'الشريك الثاني — العنوان', 'type' => 'text', 'required' => true],
                    ['name' => 'partenaire_b_ice', 'label_fr' => 'Partenaire B — ICE', 'label_ar' => 'الشريك الثاني — ICE', 'type' => 'text', 'required' => false],
                    ['name' => 'objet_partenariat', 'label_fr' => 'Objet du partenariat', 'label_ar' => 'موضوع الشراكة', 'type' => 'textarea', 'required' => true],
                    ['name' => 'repartition_benefices', 'label_fr' => 'Répartition des bénéfices (%)', 'label_ar' => 'توزيع الأرباح (%)', 'type' => 'text', 'required' => true],
                    ['name' => 'duree_annees', 'label_fr' => 'Durée (années)', 'label_ar' => 'المدة (سنوات)', 'type' => 'number', 'required' => true],
                    ['name' => 'ville', 'label_fr' => 'Ville', 'label_ar' => 'المدينة', 'type' => 'text', 'required' => true],
                    ['name' => 'date_signature', 'label_fr' => 'Date de signature', 'label_ar' => 'تاريخ التوقيع', 'type' => 'date', 'required' => true],
                ],
            ],
            [
                'slug' => 'reconnaissance-dette',
                'name_fr' => 'Reconnaissance de dette',
                'name_ar' => 'إقرار بالدين',
                'category' => 'Commercial',
                'description_fr' => 'Document par lequel une personne reconnaît devoir une somme à une autre.',
                'pdf_blade_path' => 'pdf.generic',
                'fields' => [
                    ['name' => 'debiteur_name', 'label_fr' => 'Nom du débiteur', 'label_ar' => 'اسم المدين', 'type' => 'text', 'required' => true],
                    ['name' => 'debiteur_address', 'label_fr' => 'Adresse du débiteur', 'label_ar' => 'عنوان المدين', 'type' => 'text', 'required' => true],
                    ['name' => 'debiteur_cin', 'label_fr' => 'CIN du débiteur', 'label_ar' => 'CIN المدين', 'type' => 'text', 'required' => true],
                    ['name' => 'creancier_name', 'label_fr' => 'Nom du créancier', 'label_ar' => 'اسم الدائن', 'type' => 'text', 'required' => true],
                    ['name' => 'creancier_address', 'label_fr' => 'Adresse du créancier', 'label_ar' => 'عنوان الدائن', 'type' => 'text', 'required' => true],
                    ['name' => 'montant', 'label_fr' => 'Montant de la dette', 'label_ar' => 'مبلغ الدين', 'type' => 'number', 'required' => true],
                    ['name' => 'montant_lettres', 'label_fr' => 'Montant en lettres', 'label_ar' => 'المبلغ بالأحرف', 'type' => 'text', 'required' => true],
                    ['name' => 'motif', 'label_fr' => 'Motif du prêt', 'label_ar' => 'سبب القرض', 'type' => 'textarea', 'required' => true],
                    ['name' => 'date_remboursement', 'label_fr' => 'Date de remboursement', 'label_ar' => 'تاريخ السداد', 'type' => 'date', 'required' => true],
                    ['name' => 'ville', 'label_fr' => 'Ville', 'label_ar' => 'المدينة', 'type' => 'text', 'required' => true],
                    ['name' => 'date_signature', 'label_fr' => 'Date de signature', 'label_ar' => 'تاريخ التوقيع', 'type' => 'date', 'required' => true],
                ],
            ],

            // ─── TRAVAIL ───────────────────────────────────────────
            [
                'slug' => 'contrat-travail-cdi',
                'name_fr' => 'Contrat de travail CDI',
                'name_ar' => 'عقد الشغل غير محدد المدة',
                'category' => 'Travail',
                'description_fr' => 'Contrat à Durée Indéterminée conforme au Code du travail marocain (Loi 65-99).',
                'pdf_blade_path' => 'pdf.generic',
                'fields' => [
                    ['name' => 'employeur_name', 'label_fr' => 'Nom de l\'employeur / Société', 'label_ar' => 'اسم صاحب العمل / الشركة', 'type' => 'text', 'required' => true],
                    ['name' => 'employeur_address', 'label_fr' => 'Adresse de l\'employeur', 'label_ar' => 'عنوان صاحب العمل', 'type' => 'text', 'required' => true],
                    ['name' => 'employeur_ice', 'label_fr' => 'ICE de l\'employeur', 'label_ar' => 'رقم ICE صاحب العمل', 'type' => 'text', 'required' => false],
                    ['name' => 'salarie_name', 'label_fr' => 'Nom du salarié', 'label_ar' => 'اسم الموظف', 'type' => 'text', 'required' => true],
                    ['name' => 'salarie_address', 'label_fr' => 'Adresse du salarié', 'label_ar' => 'عنوان الموظف', 'type' => 'text', 'required' => true],
                    ['name' => 'salarie_cin', 'label_fr' => 'CIN du salarié', 'label_ar' => 'CIN الموظف', 'type' => 'text', 'required' => true],
                    ['name' => 'poste', 'label_fr' => 'Poste / Fonction', 'label_ar' => 'المنصب / الوظيفة', 'type' => 'text', 'required' => true],
                    ['name' => 'salaire_brut', 'label_fr' => 'Salaire brut mensuel (MAD)', 'label_ar' => 'الراتب الإجمالي الشهري (درهم)', 'type' => 'number', 'required' => true],
                    ['name' => 'periode_essai_mois', 'label_fr' => 'Période d\'essai (mois)', 'label_ar' => 'فترة التجربة (أشهر)', 'type' => 'number', 'required' => true],
                    ['name' => 'horaires', 'label_fr' => 'Horaires de travail', 'label_ar' => 'أوقات العمل', 'type' => 'text', 'required' => true],
                    ['name' => 'date_embauche', 'label_fr' => 'Date d\'embauche', 'label_ar' => 'تاريخ التوظيف', 'type' => 'date', 'required' => true],
                    ['name' => 'ville', 'label_fr' => 'Ville', 'label_ar' => 'المدينة', 'type' => 'text', 'required' => true],
                    ['name' => 'date_signature', 'label_fr' => 'Date de signature', 'label_ar' => 'تاريخ التوقيع', 'type' => 'date', 'required' => true],
                ],
            ],
            [
                'slug' => 'contrat-travail-cdd',
                'name_fr' => 'Contrat de travail CDD',
                'name_ar' => 'عقد الشغل محدد المدة',
                'category' => 'Travail',
                'description_fr' => 'Contrat à Durée Déterminée conforme au Code du travail marocain.',
                'pdf_blade_path' => 'pdf.generic',
                'fields' => [
                    ['name' => 'employeur_name', 'label_fr' => 'Nom de l\'employeur / Société', 'label_ar' => 'اسم صاحب العمل / الشركة', 'type' => 'text', 'required' => true],
                    ['name' => 'employeur_address', 'label_fr' => 'Adresse de l\'employeur', 'label_ar' => 'عنوان صاحب العمل', 'type' => 'text', 'required' => true],
                    ['name' => 'salarie_name', 'label_fr' => 'Nom du salarié', 'label_ar' => 'اسم الموظف', 'type' => 'text', 'required' => true],
                    ['name' => 'salarie_cin', 'label_fr' => 'CIN du salarié', 'label_ar' => 'CIN الموظف', 'type' => 'text', 'required' => true],
                    ['name' => 'poste', 'label_fr' => 'Poste / Fonction', 'label_ar' => 'المنصب / الوظيفة', 'type' => 'text', 'required' => true],
                    ['name' => 'motif_cdd', 'label_fr' => 'Motif du CDD', 'label_ar' => 'سبب العقد المحدد المدة', 'type' => 'textarea', 'required' => true],
                    ['name' => 'salaire_brut', 'label_fr' => 'Salaire brut mensuel (MAD)', 'label_ar' => 'الراتب الإجمالي الشهري (درهم)', 'type' => 'number', 'required' => true],
                    ['name' => 'date_debut', 'label_fr' => 'Date de début', 'label_ar' => 'تاريخ البداية', 'type' => 'date', 'required' => true],
                    ['name' => 'date_fin', 'label_fr' => 'Date de fin', 'label_ar' => 'تاريخ النهاية', 'type' => 'date', 'required' => true],
                    ['name' => 'ville', 'label_fr' => 'Ville', 'label_ar' => 'المدينة', 'type' => 'text', 'required' => true],
                    ['name' => 'date_signature', 'label_fr' => 'Date de signature', 'label_ar' => 'تاريخ التوقيع', 'type' => 'date', 'required' => true],
                ],
            ],
            [
                'slug' => 'lettre-demission',
                'name_fr' => 'Lettre de démission',
                'name_ar' => 'رسالة الاستقالة',
                'category' => 'Travail',
                'description_fr' => 'Lettre officielle de démission avec respect du préavis légal.',
                'pdf_blade_path' => 'pdf.generic',
                'fields' => [
                    ['name' => 'salarie_name', 'label_fr' => 'Votre nom complet', 'label_ar' => 'اسمك الكامل', 'type' => 'text', 'required' => true],
                    ['name' => 'salarie_poste', 'label_fr' => 'Votre poste', 'label_ar' => 'منصبك', 'type' => 'text', 'required' => true],
                    ['name' => 'employeur_name', 'label_fr' => 'Nom de l\'employeur / Société', 'label_ar' => 'اسم صاحب العمل / الشركة', 'type' => 'text', 'required' => true],
                    ['name' => 'responsable_name', 'label_fr' => 'Nom du responsable RH / DG', 'label_ar' => 'اسم المسؤول HR / المدير العام', 'type' => 'text', 'required' => true],
                    ['name' => 'motif_demission', 'label_fr' => 'Motif de la démission (optionnel)', 'label_ar' => 'سبب الاستقالة (اختياري)', 'type' => 'textarea', 'required' => false],
                    ['name' => 'duree_preavis', 'label_fr' => 'Durée du préavis (jours)', 'label_ar' => 'مدة الإشعار (أيام)', 'type' => 'number', 'required' => true],
                    ['name' => 'date_dernier_jour', 'label_fr' => 'Date du dernier jour de travail', 'label_ar' => 'تاريخ آخر يوم عمل', 'type' => 'date', 'required' => true],
                    ['name' => 'ville', 'label_fr' => 'Ville', 'label_ar' => 'المدينة', 'type' => 'text', 'required' => true],
                    ['name' => 'date_signature', 'label_fr' => 'Date', 'label_ar' => 'التاريخ', 'type' => 'date', 'required' => true],
                ],
            ],

            // ─── IMMOBILIER ───────────────────────────────────────────
            [
                'slug' => 'contrat-bail-habitation',
                'name_fr' => 'Contrat de bail d\'habitation',
                'name_ar' => 'عقد إيجار سكني',
                'category' => 'Immobilier',
                'description_fr' => 'Contrat de location résidentielle conforme au Dahir sur les baux d\'habitation.',
                'pdf_blade_path' => 'pdf.generic',
                'fields' => [
                    ['name' => 'bailleur_name', 'label_fr' => 'Nom du bailleur (propriétaire)', 'label_ar' => 'اسم المؤجر (المالك)', 'type' => 'text', 'required' => true],
                    ['name' => 'bailleur_address', 'label_fr' => 'Adresse du bailleur', 'label_ar' => 'عنوان المؤجر', 'type' => 'text', 'required' => true],
                    ['name' => 'bailleur_cin', 'label_fr' => 'CIN du bailleur', 'label_ar' => 'CIN المؤجر', 'type' => 'text', 'required' => true],
                    ['name' => 'locataire_name', 'label_fr' => 'Nom du locataire', 'label_ar' => 'اسم المستأجر', 'type' => 'text', 'required' => true],
                    ['name' => 'locataire_cin', 'label_fr' => 'CIN du locataire', 'label_ar' => 'CIN المستأجر', 'type' => 'text', 'required' => true],
                    ['name' => 'bien_adresse', 'label_fr' => 'Adresse du bien loué', 'label_ar' => 'عنوان العقار المؤجر', 'type' => 'text', 'required' => true],
                    ['name' => 'bien_description', 'label_fr' => 'Description du bien (type, superficie...)', 'label_ar' => 'وصف العقار (النوع، المساحة...)', 'type' => 'textarea', 'required' => true],
                    ['name' => 'loyer_mensuel', 'label_fr' => 'Loyer mensuel (MAD)', 'label_ar' => 'الإيجار الشهري (درهم)', 'type' => 'number', 'required' => true],
                    ['name' => 'caution', 'label_fr' => 'Caution / Dépôt de garantie (MAD)', 'label_ar' => 'الضمان المالي (درهم)', 'type' => 'number', 'required' => true],
                    ['name' => 'date_entree', 'label_fr' => 'Date d\'entrée dans les lieux', 'label_ar' => 'تاريخ الدخول إلى العقار', 'type' => 'date', 'required' => true],
                    ['name' => 'duree_bail', 'label_fr' => 'Durée du bail (mois)', 'label_ar' => 'مدة عقد الإيجار (أشهر)', 'type' => 'number', 'required' => true],
                    ['name' => 'ville', 'label_fr' => 'Ville', 'label_ar' => 'المدينة', 'type' => 'text', 'required' => true],
                    ['name' => 'date_signature', 'label_fr' => 'Date de signature', 'label_ar' => 'تاريخ التوقيع', 'type' => 'date', 'required' => true],
                ],
            ],
            [
                'slug' => 'promesse-vente-immobiliere',
                'name_fr' => 'Promesse de vente immobilière',
                'name_ar' => 'وعد بالبيع العقاري',
                'category' => 'Immobilier',
                'description_fr' => 'Avant-contrat engageant vendeur et acheteur avant la signature de l\'acte définitif.',
                'pdf_blade_path' => 'pdf.generic',
                'fields' => [
                    ['name' => 'vendeur_name', 'label_fr' => 'Nom du vendeur', 'label_ar' => 'اسم البائع', 'type' => 'text', 'required' => true],
                    ['name' => 'vendeur_cin', 'label_fr' => 'CIN du vendeur', 'label_ar' => 'CIN البائع', 'type' => 'text', 'required' => true],
                    ['name' => 'acheteur_name', 'label_fr' => 'Nom de l\'acheteur', 'label_ar' => 'اسم المشتري', 'type' => 'text', 'required' => true],
                    ['name' => 'acheteur_cin', 'label_fr' => 'CIN de l\'acheteur', 'label_ar' => 'CIN المشتري', 'type' => 'text', 'required' => true],
                    ['name' => 'bien_description', 'label_fr' => 'Description du bien immobilier', 'label_ar' => 'وصف العقار', 'type' => 'textarea', 'required' => true],
                    ['name' => 'bien_titre_foncier', 'label_fr' => 'Numéro du titre foncier', 'label_ar' => 'رقم الرسم العقاري', 'type' => 'text', 'required' => false],
                    ['name' => 'prix_vente', 'label_fr' => 'Prix de vente (MAD)', 'label_ar' => 'ثمن البيع (درهم)', 'type' => 'number', 'required' => true],
                    ['name' => 'avance', 'label_fr' => 'Avance versée (MAD)', 'label_ar' => 'المبلغ المدفوع مقدماً (درهم)', 'type' => 'number', 'required' => true],
                    ['name' => 'date_signature_acte', 'label_fr' => 'Date prévue de signature de l\'acte définitif', 'label_ar' => 'التاريخ المقرر لإبرام العقد النهائي', 'type' => 'date', 'required' => true],
                    ['name' => 'ville', 'label_fr' => 'Ville', 'label_ar' => 'المدينة', 'type' => 'text', 'required' => true],
                    ['name' => 'date_signature', 'label_fr' => 'Date de signature', 'label_ar' => 'تاريخ التوقيع', 'type' => 'date', 'required' => true],
                ],
            ],

            // ─── SOCIÉTÉ ───────────────────────────────────────────
            [
                'slug' => 'statuts-sarl',
                'name_fr' => 'Statuts de SARL',
                'name_ar' => 'النظام الأساسي لشركة ذات مسؤولية محدودة',
                'category' => 'Société',
                'description_fr' => 'Statuts constitutifs d\'une SARL conforme à la loi 5-96 sur les sociétés.',
                'pdf_blade_path' => 'pdf.generic',
                'fields' => [
                    ['name' => 'denomination', 'label_fr' => 'Dénomination sociale', 'label_ar' => 'التسمية الاجتماعية', 'type' => 'text', 'required' => true],
                    ['name' => 'objet_social', 'label_fr' => 'Objet social', 'label_ar' => 'الغرض الاجتماعي', 'type' => 'textarea', 'required' => true],
                    ['name' => 'siege_social', 'label_fr' => 'Siège social', 'label_ar' => 'المقر الاجتماعي', 'type' => 'text', 'required' => true],
                    ['name' => 'capital_social', 'label_fr' => 'Capital social (MAD)', 'label_ar' => 'رأس المال الاجتماعي (درهم)', 'type' => 'number', 'required' => true],
                    ['name' => 'nombre_parts', 'label_fr' => 'Nombre de parts sociales', 'label_ar' => 'عدد الحصص الاجتماعية', 'type' => 'number', 'required' => true],
                    ['name' => 'associes', 'label_fr' => 'Liste des associés et leurs apports', 'label_ar' => 'قائمة الشركاء وحصصهم', 'type' => 'textarea', 'required' => true],
                    ['name' => 'gerant_name', 'label_fr' => 'Nom du gérant', 'label_ar' => 'اسم المدير', 'type' => 'text', 'required' => true],
                    ['name' => 'gerant_cin', 'label_fr' => 'CIN du gérant', 'label_ar' => 'CIN المدير', 'type' => 'text', 'required' => true],
                    ['name' => 'duree_societe', 'label_fr' => 'Durée de la société (années)', 'label_ar' => 'مدة الشركة (سنوات)', 'type' => 'number', 'required' => true],
                    ['name' => 'exercice_social', 'label_fr' => 'Exercice social (ex: 1er janvier — 31 décembre)', 'label_ar' => 'السنة المالية', 'type' => 'text', 'required' => true],
                    ['name' => 'ville', 'label_fr' => 'Ville', 'label_ar' => 'المدينة', 'type' => 'text', 'required' => true],
                    ['name' => 'date_signature', 'label_fr' => 'Date de constitution', 'label_ar' => 'تاريخ التأسيس', 'type' => 'date', 'required' => true],
                ],
            ],

            // ─── PERSONNEL ───────────────────────────────────────────
            [
                'slug' => 'procuration-generale',
                'name_fr' => 'Procuration générale',
                'name_ar' => 'توكيل عام',
                'category' => 'Personnel',
                'description_fr' => 'Donne pouvoir à une tierce personne d\'agir en votre nom pour un ensemble d\'actes.',
                'pdf_blade_path' => 'pdf.generic',
                'fields' => [
                    ['name' => 'mandant_name', 'label_fr' => 'Nom du mandant (donneur d\'ordre)', 'label_ar' => 'اسم الموكِّل', 'type' => 'text', 'required' => true],
                    ['name' => 'mandant_cin', 'label_fr' => 'CIN du mandant', 'label_ar' => 'CIN الموكِّل', 'type' => 'text', 'required' => true],
                    ['name' => 'mandant_address', 'label_fr' => 'Adresse du mandant', 'label_ar' => 'عنوان الموكِّل', 'type' => 'text', 'required' => true],
                    ['name' => 'mandataire_name', 'label_fr' => 'Nom du mandataire (représentant)', 'label_ar' => 'اسم الوكيل', 'type' => 'text', 'required' => true],
                    ['name' => 'mandataire_cin', 'label_fr' => 'CIN du mandataire', 'label_ar' => 'CIN الوكيل', 'type' => 'text', 'required' => true],
                    ['name' => 'mandataire_address', 'label_fr' => 'Adresse du mandataire', 'label_ar' => 'عنوان الوكيل', 'type' => 'text', 'required' => true],
                    ['name' => 'objet_procuration', 'label_fr' => 'Objet et étendue des pouvoirs', 'label_ar' => 'موضوع وحدود الصلاحيات', 'type' => 'textarea', 'required' => true],
                    ['name' => 'duree_validite', 'label_fr' => 'Durée de validité', 'label_ar' => 'مدة الصلاحية', 'type' => 'text', 'required' => true],
                    ['name' => 'ville', 'label_fr' => 'Ville', 'label_ar' => 'المدينة', 'type' => 'text', 'required' => true],
                    ['name' => 'date_signature', 'label_fr' => 'Date de signature', 'label_ar' => 'تاريخ التوقيع', 'type' => 'date', 'required' => true],
                ],
            ],
        ];

        foreach ($templates as $tpl) {
            Template::updateOrCreate(
                ['slug' => $tpl['slug']],
                array_merge($tpl, ['is_active' => true])
            );
        }
    }
}
