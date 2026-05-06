<x-app-layout>
    <style>
        .courses-container {
            padding: 40px 48px;
            min-height: 100%;
            /* Dotted pattern background */
            background-image: radial-gradient(rgba(255, 255, 255, 0.08) 2px, transparent 2px);
            background-size: 36px 36px;
            background-position: 0 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .breadcrumb {
            color: var(--text-muted);
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .breadcrumb span {
            color: #f8fafc;
        }
        .breadcrumb svg {
            width: 14px;
            height: 14px;
        }

        .page-header h1 {
            font-size: 2.25rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 12px;
            letter-spacing: -0.02em;
        }
        .page-header p {
            color: #94a3b8;
            font-size: 1.05rem;
            margin-bottom: 48px;
            max-width: 800px;
            line-height: 1.6;
        }

        .filters-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 48px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .filter-tabs {
            display: flex;
            gap: 16px;
        }

        .filter-btn {
            padding: 10px 28px;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            background: transparent;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .filter-btn.all { border: 1px solid rgba(124, 58, 237, 0.4); color: #a78bfa; }
        .filter-btn.all.active, .filter-btn.all:hover { 
            background: rgba(124, 58, 237, 0.15); 
            border-color: #7c3aed; 
            color: #c4b5fd;
            box-shadow: 0 0 16px rgba(124, 58, 237, 0.25); 
        }

        .filter-btn.beginner { border: 1px solid rgba(16, 185, 129, 0.4); color: #34d399; }
        .filter-btn.beginner.active, .filter-btn.beginner:hover { 
            background: rgba(16, 185, 129, 0.15); 
            border-color: #10b981; 
            color: #6ee7b7;
            box-shadow: 0 0 16px rgba(16, 185, 129, 0.25); 
        }

        .filter-btn.amateur { border: 1px solid rgba(59, 130, 246, 0.4); color: #60a5fa; }
        .filter-btn.amateur.active, .filter-btn.amateur:hover { 
            background: rgba(59, 130, 246, 0.15); 
            border-color: #3b82f6; 
            color: #93c5fd;
            box-shadow: 0 0 16px rgba(59, 130, 246, 0.25); 
        }

        .filter-btn.pro { border: 1px solid rgba(249, 115, 22, 0.4); color: #fb923c; }
        .filter-btn.pro.active, .filter-btn.pro:hover { 
            background: rgba(249, 115, 22, 0.15); 
            border-color: #f97316; 
            color: #fdba74;
            box-shadow: 0 0 16px rgba(249, 115, 22, 0.25); 
        }

        .search-box {
            position: relative;
            width: 320px;
        }
        .search-box input {
            width: 100%;
            background: rgba(15, 23, 42, 0.7);
            border: 1px solid rgba(124, 58, 237, 0.3);
            border-radius: 12px;
            padding: 12px 44px 12px 20px;
            color: #fff;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }
        .search-box input:focus {
            outline: none;
            border-color: #a78bfa;
            box-shadow: 0 0 0 1px #a78bfa, 0 0 15px rgba(124, 58, 237, 0.2);
        }
        .search-box input::placeholder {
            color: #475569;
        }
        .search-box svg {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            color: #7c3aed;
            pointer-events: none;
        }

        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 28px;
            padding-bottom: 40px;
        }

        .course-card {
            background: rgba(15, 23, 42, 0.85);
            border-radius: 16px;
            padding: 28px;
            position: relative;
            display: flex;
            flex-direction: column;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(12px);
            min-height: 280px;
            text-decoration: none;
            cursor: pointer;
        }

        .course-card:not(.locked):hover {
            transform: translateY(-6px);
        }

        /* Card Difficulty Themes */
        .course-card.beginner {
            border: 2px solid #10b981;
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.1);
        }
        .course-card.beginner:not(.locked):hover { box-shadow: 0 10px 30px rgba(16, 185, 129, 0.25); }

        .course-card.amateur {
            border: 2px solid #3b82f6;
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.1);
        }
        .course-card.amateur:not(.locked):hover { box-shadow: 0 10px 30px rgba(59, 130, 246, 0.25); }

        .course-card.pro {
            border: 2px solid #f97316;
            box-shadow: 0 0 20px rgba(249, 115, 22, 0.1);
        }
        .course-card.pro:not(.locked):hover { box-shadow: 0 10px 30px rgba(249, 115, 22, 0.25); }

        .card-icon-wrapper {
            margin-bottom: 24px;
        }
        .card-icon-wrapper svg {
            width: 56px;
            height: 56px;
            color: #ffffff;
        }

        .card-title {
            font-size: 1.35rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .card-desc {
            font-size: 0.9rem;
            color: #94a3b8;
            line-height: 1.6;
            flex-grow: 1;
            margin-bottom: 28px;
        }

        .card-footer {
            margin-top: auto;
        }

        .card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .stars {
            display: flex;
            gap: 4px;
        }
        .stars svg {
            width: 18px;
            height: 18px;
        }
        .stars .star-filled { color: #facc15; fill: #facc15; }
        .stars .star-empty { color: transparent; stroke: #475569; stroke-width: 2px; }

        .progress-text {
            font-size: 0.75rem;
            color: #94a3b8;
            font-weight: 600;
            letter-spacing: 0.02em;
        }

        .progress-bar-bg {
            width: 100%;
            height: 6px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            border-radius: 4px;
            background: #22c55e;
            box-shadow: 0 0 10px rgba(34, 197, 94, 0.6);
            transition: width 1s ease-out;
        }

        /* Locked State */
        .course-card.locked {
            border-color: rgba(71, 85, 105, 0.6);
            box-shadow: none;
        }
        .course-card.locked::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(15, 23, 42, 0.4);
            border-radius: 14px;
            z-index: 1;
        }
        .course-card.locked .card-title,
        .course-card.locked .card-desc,
        .course-card.locked .card-icon-wrapper {
            opacity: 0.4;
        }
        .course-card.locked .progress-bar-fill {
            background: #475569;
            box-shadow: none;
        }
        .course-card.locked .stars .star-empty {
            stroke: #334155;
        }
        .locked-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
        }
        .locked-icon svg {
            width: 72px;
            height: 72px;
            color: #ffffff;
            filter: drop-shadow(0 4px 12px rgba(0,0,0,0.5));
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .courses-container {
                padding: 24px;
            }
            .filters-bar {
                flex-direction: column;
                align-items: flex-start;
            }
            .search-box {
                width: 100%;
            }
            .filter-tabs {
                width: 100%;
                overflow-x: auto;
                padding-bottom: 8px;
            }
            .filter-btn {
                white-space: nowrap;
            }
        }
    </style>

    <div class="courses-container">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            Home 
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span>Courses</span>
        </div>

        <!-- Header -->
        <div class="page-header">
            <h1>Pilih Materi dan Selesaikan Puzzle-nya</h1>
            <p>Pilih topik yang ingin kamu pelajari. Selesaikan level sebelumnya untuk membuka level berikutnya.</p>
        </div>

        <!-- Filters & Search -->
        <div class="filters-bar">
            <div class="filter-tabs">
                <button class="filter-btn all active">Semua</button>
                <button class="filter-btn beginner">Beginner</button>
                <button class="filter-btn amateur">Amateur</button>
                <button class="filter-btn pro">Pro</button>
            </div>
            <div class="search-box">
                <input type="text" placeholder="Cari Materi">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        <!-- Courses Grid -->
        <div class="courses-grid">
            
            <!-- Card 1 -->
            <div class="course-card beginner">
                <div class="card-icon-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M4 5h16v4H4V5zm0 6h16v8a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-8zm4 3v2h8v-2H8z" />
                    </svg>
                </div>
                <h3 class="card-title">Variabel & Tipe Data</h3>
                <p class="card-desc">Pelajari cara menyimpan data: angka, teks, boolean, dan lainnya dalam variabel.</p>
                <div class="card-footer">
                    <div class="card-meta">
                        <div class="stars">
                            <svg class="star-filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            <svg class="star-filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            <svg class="star-filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        </div>
                        <span class="progress-text">100% Selesai</span>
                    </div>
                    <div class="progress-bar-bg">
                        <div class="progress-bar-fill" style="width: 100%"></div>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="course-card beginner">
                <div class="card-icon-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.0165 17.6336H3.83636V16.4336H21.0165V17.6336Z"/>
                        <path d="M7.09808 13.3967V7.50803H5.74066L3.83636 8.78244V10.091L5.65277 8.88498H5.74066V13.3967H3.84125V14.5539H8.89984V13.3967H7.09808Z"/>
                        <path d="M9.81781 9.63205V9.66135H11.1069V9.62717C11.1069 8.95334 11.5756 8.49435 12.2739 8.49435C12.9575 8.49435 13.4018 8.89474 13.4018 9.5051C13.4018 9.97873 13.1528 10.3498 12.1909 11.3117L9.89594 13.5822V14.5539H14.8618V13.3869H11.7807V13.299L13.1577 11.9856C14.3491 10.843 14.7543 10.1838 14.7543 9.41232C14.7543 8.19162 13.7729 7.36642 12.3178 7.36642C10.8383 7.36642 9.81781 8.28439 9.81781 9.63205Z"/>
                        <path d="M17.6694 11.4631H18.5092C19.3198 11.4631 19.8422 11.8684 19.8422 12.4983C19.8422 13.1184 19.3295 13.5139 18.5239 13.5139C17.767 13.5139 17.2592 13.133 17.2104 12.5324H15.9262C15.9897 13.8508 17.0248 14.6955 18.5629 14.6955C20.1401 14.6955 21.2192 13.841 21.2192 12.591C21.2192 11.6584 20.6528 11.0334 19.7006 10.9211V10.8332C20.4721 10.677 20.9457 10.0666 20.9457 9.23654C20.9457 8.12326 19.9741 7.36642 18.5434 7.36642C17.0541 7.36642 16.1118 8.17697 16.0629 9.50021H17.2983C17.3422 8.8801 17.8061 8.48459 18.4995 8.48459C19.2075 8.48459 19.6567 8.85568 19.6567 9.44162C19.6567 10.0324 19.1977 10.4182 18.4946 10.4182H17.6694V11.4631Z"/>
                    </svg>
                </div>
                <h3 class="card-title">Operator & Ekspresi</h3>
                <p class="card-desc">Matematika dalam kode: penjumlahan, perbandingan, dan logika boolean.</p>
                <div class="card-footer">
                    <div class="card-meta">
                        <div class="stars">
                            <svg class="star-filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            <svg class="star-filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            <svg class="star-filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        </div>
                        <span class="progress-text">100% Selesai</span>
                    </div>
                    <div class="progress-bar-bg">
                        <div class="progress-bar-fill" style="width: 100%"></div>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="course-card amateur">
                <div class="card-icon-wrapper">
                    <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"></path>
                    </svg>
                </div>
                <h3 class="card-title">Input & Output</h3>
                <p class="card-desc">Cara menerima masukan dari pengguna dan menampilkan hasil ke layar.</p>
                <div class="card-footer">
                    <div class="card-meta">
                        <div class="stars">
                            <svg class="star-filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            <svg class="star-filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            <svg class="star-empty" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                        </div>
                        <span class="progress-text">100% Selesai</span>
                    </div>
                    <div class="progress-bar-bg">
                        <div class="progress-bar-fill" style="width: 100%"></div>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="course-card amateur">
                <div class="card-icon-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 6a9 9 0 0 0-9 9V3"/><circle cx="18" cy="6" r="3"/><circle cx="6" cy="18" r="3"/>
                    </svg>                    
                </div>
                <h3 class="card-title">Percabangan (if/else)</h3>
                <p class="card-desc">Buat program yang bisa mengambil keputusan berdasarkan kondisi.</p>
                <div class="card-footer">
                    <div class="card-meta">
                        <div class="stars">
                            <svg class="star-empty" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                            <svg class="star-empty" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                            <svg class="star-empty" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                        </div>
                        <span class="progress-text">25% Selesai</span>
                    </div>
                    <div class="progress-bar-bg">
                        <div class="progress-bar-fill" style="width: 25%"></div>
                    </div>
                </div>
            </div>

            <!-- Card 5 (Locked) -->
            <div class="course-card pro locked">
                <div class="locked-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="card-icon-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m17 2 4 4-4 4"/>
                        <path d="M3 11v-1a4 4 0 0 1 4-4h14"/>
                        <path d="m7 22-4-4 4-4"/>
                        <path d="M21 13v1a4 4 0 0 1-4 4H3"/>
                </svg>
                </div>
                <h3 class="card-title">Perulangan (for & while)</h3>
                <p class="card-desc">Jalankan instruksi berulang kali secara efisien dengan loop.</p>
                <div class="card-footer">
                    <div class="card-meta">
                        <div class="stars">
                            <svg class="star-empty" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                            <svg class="star-empty" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                            <svg class="star-empty" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                        </div>
                        <span class="progress-text">0% Selesai</span>
                    </div>
                    <div class="progress-bar-bg">
                        <div class="progress-bar-fill" style="width: 0%"></div>
                    </div>
                </div>
            </div>

            <!-- Card 6 (Locked) -->
            <div class="course-card pro locked">
                <div class="locked-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="card-icon-wrapper">
                    <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                    </svg>
                </div>
                <h3 class="card-title">Fungsi & Parameter</h3>
                <p class="card-desc">Buat blok kode yang dapat dipanggil ulang dengan cara yang efisien.</p>
                <div class="card-footer">
                    <div class="card-meta">
                        <div class="stars">
                            <svg class="star-empty" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                            <svg class="star-empty" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                            <svg class="star-empty" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                        </div>
                        <span class="progress-text">0% Selesai</span>
                    </div>
                    <div class="progress-bar-bg">
                        <div class="progress-bar-fill" style="width: 0%"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtns = document.querySelectorAll('.filter-btn');
            const courses = document.querySelectorAll('.course-card');
            const searchInput = document.querySelector('.search-box input');
            
            // Store original text of titles and descriptions to allow resetting before highlighting
            courses.forEach((course, index) => {
                const titleEl = course.querySelector('.card-title');
                const descEl = course.querySelector('.card-desc');
                course.dataset.originalTitle = titleEl.textContent;
                course.dataset.originalDesc = descEl.textContent;
                
                // Add click listener for navigation
                course.addEventListener('click', () => {
                    if (!course.classList.contains('locked')) {
                        // Normally you'd pass the real course ID, here we use index + 1 for demo
                        window.location.href = `/courses/${index + 1}`;
                    }
                });
            });

            let currentFilter = 'all';
            let searchQuery = '';

            function escapeRegExp(string) {
                return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'); // $& means the whole matched string
            }

            function highlightText(text, query) {
                if (!query) return text;
                const escapedQuery = escapeRegExp(query);
                const regex = new RegExp(`(${escapedQuery})`, 'gi');
                return text.replace(regex, `<span style="background-color: #3b82f6; color: white; border-radius: 2px; padding: 0 2px;">$1</span>`);
            }

            function updateUI() {
                courses.forEach(course => {
                    const isBeginner = course.classList.contains('beginner');
                    const isAmateur = course.classList.contains('amateur');
                    const isPro = course.classList.contains('pro');

                    let matchesFilter = false;
                    if (currentFilter === 'all') matchesFilter = true;
                    else if (currentFilter === 'beginner' && isBeginner) matchesFilter = true;
                    else if (currentFilter === 'amateur' && isAmateur) matchesFilter = true;
                    else if (currentFilter === 'pro' && isPro) matchesFilter = true;

                    const originalTitle = course.dataset.originalTitle;
                    const originalDesc = course.dataset.originalDesc;
                    
                    const titleMatch = originalTitle.toLowerCase().includes(searchQuery.toLowerCase());
                    const descMatch = originalDesc.toLowerCase().includes(searchQuery.toLowerCase());
                    const matchesSearch = searchQuery === '' || titleMatch || descMatch;

                    if (matchesFilter && matchesSearch) {
                        course.style.display = 'flex';
                        
                        // Apply highlighting
                        const titleEl = course.querySelector('.card-title');
                        const descEl = course.querySelector('.card-desc');
                        
                        titleEl.innerHTML = highlightText(originalTitle, searchQuery);
                        descEl.innerHTML = highlightText(originalDesc, searchQuery);
                    } else {
                        course.style.display = 'none';
                    }
                });
            }

            // Filter Buttons Click
            filterBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    // Remove active class from all
                    filterBtns.forEach(b => b.classList.remove('active'));
                    // Add active to clicked
                    btn.classList.add('active');
                    
                    if (btn.classList.contains('all')) currentFilter = 'all';
                    else if (btn.classList.contains('beginner')) currentFilter = 'beginner';
                    else if (btn.classList.contains('amateur')) currentFilter = 'amateur';
                    else if (btn.classList.contains('pro')) currentFilter = 'pro';
                    
                    updateUI();
                });
            });

            // Search Box Input (Real-time and Enter)
            searchInput.addEventListener('input', (e) => {
                searchQuery = e.target.value.trim();
                updateUI();
            });
            
            searchInput.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    searchQuery = e.target.value.trim();
                    updateUI();
                }
            });
        });
    </script>
</x-app-layout>
