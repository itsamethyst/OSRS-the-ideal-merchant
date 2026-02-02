# OSRS: The Ideal Merchant

**OSRS The Ideal Merchant** is een systeem voor het analyseren van de Grand Exchange in Old School RuneScape. Het helpt spelers bij het plannen van flips en het maken van winst door **kortetermijn- en langetermijnmarktanalyse**, visuele grafieken, en toekomstige AI-ondersteuning voor geavanceerde strategieën.

> Let op: dit systeem voert **geen acties in het spel automatisch uit**. Alle aankopen en verkopen moeten handmatig in-game worden gedaan.

---

## 🛠️ Tech Stack

- **Backend:** Laravel 12  
- **Frontend:** Vue.js + Inertia.js  
- **Database:** MySQL/PostgreSQL (optioneel, voor data-analyse)  
- **Charts & Visuals:** (bijv. Chart.js, TailwindCSS voor styling)  
- **Version Control:** Git + GitHub (SSH)

---

## ⚡ Features (Fase 1)

- ✅ Dashboard met overzicht van flips  
- ✅ Korte- en langetermijnprijsanalyses  
- ✅ Grafieken en visuele representaties van data  
- ✅ GitHub repository live via SSH  
- ✅ Eenvoudige uitbreiding met AI in de toekomst  

---

## 🚀 Installatie & Setup

1. **Clone de repository:**

```bash
git clone git@github.com:itsamethyst/OSRS-the-ideal-merchant.git
cd OSRS-the-ideal-merchant


composer install
npm install
npm run dev

cp .env.example .env

php artisan migrate
php artisan db:seed

php artisan serve

```

📝 Gebruik

Voeg items toe aan je database om flips te analyseren

Bekijk korte- en langetermijngrafieken

Ontvang meldingen (in de toekomst) over goede koop/verkoop momenten

📈 Roadmap

 AI-assistent voor winstoptimalisatie

 Real-time prijsalerts

 Export naar CSV/Excel

 Extra grafieksoorten en filters

🖤 Bijdragen

Contributions zijn welkom! Open een pull request of meld issues voor bugs/features.