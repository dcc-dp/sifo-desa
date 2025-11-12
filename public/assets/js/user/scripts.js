
        const pageMap = {
            'home': 'home-page',
            'news': 'news-page',
            'agenda': 'agenda-page',
            'gallery': 'gallery-page',
            'government': 'government-page',
            'complaints': 'complaints-page',
            'services': 'services-page',
            'profile': 'profile-page',
            'login': 'login-page',
            'register': 'register-page',
            'news-detail': 'news-detail-page', // For news detail
            'gallery-detail': 'gallery-detail-container', // For gallery detail
            'complaint-detail': 'complaint-detail-page' // For complaint detail
        };

        // Function to navigate between pages
        function navigate(pageName, params = {}) {
            const allPages = document.querySelectorAll('.page-section, #gallery-detail-container');
            const targetPageId = pageMap[pageName];

            if (!targetPageId) return;

            // 1. Hide all pages
            allPages.forEach(page => {
                page.classList.remove('active');
                page.style.display = 'none';
            });
            
            // 2. Hide specific nested containers (like the dynamic service form)
            document.getElementById('service-form-container').style.display = 'none';

            // 3. Handle Auth Pages visibility (hiding main header/footer)
            const isAuthPage = pageName === 'login' || pageName === 'register';
            document.getElementById('main-header').style.display = isAuthPage ? 'none' : 'block';
            document.getElementById('main-footer').style.display = isAuthPage ? 'none' : 'block';


            // 4. Show the target page
            const targetPage = document.getElementById(targetPageId);
            if (targetPage) {
                targetPage.classList.add('active');
                targetPage.style.display = 'block';
                window.scrollTo(0, 0); // Scroll to top on navigation

                // 5. Run page-specific logic
                if (pageName === 'news-detail') {
                    renderNewsDetail(params.id);
                } else if (pageName === 'gallery-detail') {
                    renderGalleryDetail(params.album);
                    document.getElementById('album-list').style.display = 'none';
                } else if (pageName === 'gallery') {
                    document.getElementById('gallery-detail-container').style.display = 'none';
                    document.getElementById('album-list').style.display = 'grid';
                } else if (pageName === 'complaint-detail') {
                    renderComplaintDetail(params.id);
                }
            }

            // 6. Update Active Navigation Link
            document.querySelectorAll('.nav-links a').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('data-page') === pageName.split('-')[0]) {
                    link.classList.add('active');
                }
            });
            
            // Close mobile menu after navigation
            document.getElementById('nav-links').classList.remove('active');
            
        }

        // News Detail Simulation
        const newsData = {
            1: { title: "Pembangunan Jalan Baru Desa Berjalan Lancar", category: "Pembangunan", date: "25 Okt 2025", content: "Proyek pembangunan jalan desa sepanjang 5 km telah selesai dan diresmikan oleh Kepala Desa...", image: "https://picsum.photos/800/400?random=1" },
            2: { title: "Pelatihan UMKM Digital untuk Warga", category: "Ekonomi", date: "18 Okt 2025", content: "Warga antusias mengikuti pelatihan pemasaran digital untuk meningkatkan omzet usaha mikro mereka...", image: "https://picsum.photos/800/400?random=2" },
            3: { title: "Sosialisasi Program Bantuan Sosial Terbaru", category: "Sosial", date: "10 Okt 2025", content: "Pemerintah desa gencar melakukan sosialisasi dan fogging di daerah rawan...", image: "https://picsum.photos/800/400?random=3" }
        };

        function renderNewsDetail(id) {
            const article = newsData[id];
            if (article) {
                document.getElementById('news-detail-title').textContent = article.title;
                document.getElementById('news-detail-category').textContent = article.category;
                document.getElementById('news-detail-date').textContent = article.date;
                document.getElementById('news-detail-image').src = article.image;
                document.getElementById('news-detail-content').innerHTML = `<p>${article.content.repeat(3)} <a href="#" style="font-style: normal;">Read full details...</a></p>`;
            }
        }
        
        // Gallery Detail Simulation
        const galleryData = {
            pembangunan: { title: "Pembangunan Infrastruktur", photos: [17, 18, 19, 20, 21, 22] },
            budaya: { title: "Acara Adat & Budaya", photos: [23, 24, 25, 26, 27, 28] },
            gotongroyong: { title: "Kegiatan Gotong Royong", photos: [29, 30, 31, 32] }
        };
        
        function renderGalleryDetail(album) {
            const data = galleryData[album];
            const galleryGrid = document.getElementById('photo-gallery-grid');
            galleryGrid.innerHTML = '';
            
            if (data) {
                document.getElementById('gallery-detail-title').textContent = `Album: ${data.title}`;
                data.photos.forEach(id => {
                    galleryGrid.innerHTML += `<img src="https://picsum.photos/400/300?random=${id}" alt="Photo ${id}" onclick="showLightbox('https://picsum.photos/800/600?random=${id}')">`;
                });
            }
        }
        
        // Complaint Detail Simulation
        const complaintData = {
            1: { title: "Lampu Jalan Mati di Depan Balai Desa", category: "Infrastruktur", date: "15 Oct 2025", status: "Completed", statusClass: "status-completed", desc: "Beberapa lampu jalan di sekitar balai desa mati sejak 3 hari lalu, mohon segera ditindaklanjuti karena mengganggu keamanan.", attachments: [{name: "photo-jalan-mati.jpg", type: "image"}] },
            2: { title: "Respon Lambat Permintaan Surat Pengantar", category: "Pelayanan", date: "20 Oct 2025", status: "In Process", statusClass: "status-in-process", desc: "Saya sudah mengajukan permohonan surat pengantar sejak seminggu yang lalu, namun belum ada kabar mengenai prosesnya.", attachments: [] },
            3: { title: "Usulan Penolakan Pembangunan Posyandu", category: "APBDes", date: "28 Oct 2025", status: "Rejected", statusClass: "status-rejected", desc: "Saya dan beberapa warga keberatan dengan lokasi pembangunan posyandu yang dianggarkan karena terlalu dekat dengan sungai.", attachments: [{name: "letter-of-objection.pdf", type: "file"}] },
        };
        
        function renderComplaintDetail(id) {
            const comp = complaintData[id];
            if (comp) {
                document.getElementById('comp-detail-title').textContent = comp.title;
                document.getElementById('comp-detail-category').textContent = comp.category;
                document.getElementById('comp-detail-date').textContent = comp.date;
                document.getElementById('comp-detail-status').textContent = comp.status;
                document.getElementById('comp-detail-status').className = `status-badge ${comp.statusClass}`;
                document.getElementById('comp-detail-desc').textContent = comp.desc;
                
                const attList = document.getElementById('comp-detail-attachments');
                attList.innerHTML = '';
                if (comp.attachments.length > 0) {
                    comp.attachments.forEach(att => {
                        attList.innerHTML += `<li style="padding-bottom: 5px;"><i class="fas fa-${att.type === 'image' ? 'image' : 'file'}"></i> <a href="#">${att.name}</a></li>`;
                    });
                } else {
                    attList.innerHTML = '<p style="color: var(--color-text-light);">No attachments.</p>';
                }
            }
        }
        
        // Service Form Logic
        const serviceForms = {
            usaha: { title: "Surat Keterangan Usaha (SKU)", fields: [
                { id: 'bisnis-name', label: 'Business Name', type: 'text' },
                { id: 'bisnis-type', label: 'Business Type', type: 'text' },
                { id: 'bisnis-address', label: 'Business Address', type: 'textarea' },
            ]},
            domisili: { title: "Surat Keterangan Domisili", fields: [
                { id: 'old-address', label: 'Old Address', type: 'textarea' },
                { id: 'move-date', label: 'Move Date', type: 'date' },
                { id: 'family-members', label: 'Number of Family Members', type: 'number' },
            ]},
            izin_acara: { title: "Surat Izin Acara/Keramaian", fields: [
                { id: 'event-name', label: 'Event Name', type: 'text' },
                { id: 'event-date', label: 'Date and Time', type: 'datetime-local' },
                { id: 'event-location', label: 'Location', type: 'textarea' },
            ]},
            pengantar: { title: "Surat Pengantar Umum", fields: [
                { id: 'purpose', label: 'Purpose of Letter', type: 'textarea' },
                { id: 'destination', label: 'Destination Institution', type: 'text' },
            ]},
            sktm: { title: "SKTM (Surat Keterangan Tidak Mampu)", fields: [
                { id: 'income', label: 'Monthly Household Income', type: 'number' },
                { id: 'family-size', label: 'Number of Dependents', type: 'number' },
                { id: 'asset-desc', label: 'Assets Description', type: 'textarea' },
            ]}
        };
        
        function showServiceForm(type) {
            const formContainer = document.getElementById('service-form-container');
            const formTitle = document.getElementById('service-form-title');
            const dynamicForm = document.getElementById('dynamic-service-form');
            const formInfo = serviceForms[type];
            
            if (!formInfo) return;

            formContainer.style.display = 'block';
            formTitle.textContent = formInfo.title;
            dynamicForm.innerHTML = ''; // Clear previous fields
            
            formInfo.fields.forEach(field => {
                let inputHtml = '';
                if (field.type === 'textarea') {
                    inputHtml = `<textarea id="${field.id}" rows="4" required></textarea>`;
                } else if (field.type === 'select') {
                    // Assuming select fields are for future implementation
                    inputHtml = `<select id="${field.id}" required>
                                    <option value="">Select an option</option>
                                    <option value="A">Option A</option>
                                    <option value="B">Option B</option>
                                 </select>`;
                } else {
                    inputHtml = `<input type="${field.type}" id="${field.id}" required>`;
                }
                
                dynamicForm.innerHTML += `
                    <div class="form-group">
                        <label for="${field.id}">${field.label}</label>
                        ${inputHtml}
                    </div>
                `;
            });

            // Add the submit button back
            dynamicForm.innerHTML += `<button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px;">Submit Request</button>`;

            // Scroll to the form
            formContainer.scrollIntoView({ behavior: 'smooth' });
        }


        // --- Event Listeners and Initial Load ---
        
        // 1. Initial Page Load (Start on Home)
        document.addEventListener('DOMContentLoaded', () => {
            navigate('home');
        });

        // 2. Navigation Links Listener
        document.querySelectorAll('[data-page]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const page = this.getAttribute('data-page');
                // Check if it's a detail page link from the list, otherwise just navigate
                if (page === 'news-detail' || page === 'gallery-detail' || page === 'complaint-detail') {
                    // The list items on the homepage already call navigate with params, 
                    // this handles the main nav (e.g., just 'news')
                    navigate(page.split('-')[0]); 
                } else {
                    navigate(page);
                }
            });
        });

        // 3. Mobile Menu Toggle
        document.getElementById('menu-toggle').addEventListener('click', () => {
            document.getElementById('nav-links').classList.toggle('active');
        });

        // 4. Form Submission Mock
        document.getElementById('complaint-form').addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Complaint submitted successfully! Your tracking ID is #202511004. Status: In Process.');
            // Clear form and navigate (simulated)
            e.target.reset();
            navigate('complaints');
        });
        
        document.getElementById('dynamic-service-form').addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Letter request submitted successfully! Check the history table for status updates.');
            // Clear form and navigate (simulated)
            e.target.innerHTML = `<p style="color: var(--color-primary-dark); text-align: center; font-style: italic; padding: 20px;">Your request has been sent. Thank you!</p>`;
        });
        
        // 5. Lightbox for Gallery (Simple Mockup)
        function showLightbox(imageUrl) {
            const lightbox = document.createElement('div');
            lightbox.style.cssText = `
                position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                background-color: rgba(0, 0, 0, 0.9); z-index: 2000;
                display: flex; justify-content: center; align-items: center;
                cursor: pointer;
            `;
            lightbox.innerHTML = `<img src="${imageUrl}" style="max-width: 90%; max-height: 90%; border-radius: 10px;">`;
            
            lightbox.onclick = () => lightbox.remove();
            document.body.appendChild(lightbox);
        }
        
        // 6. Function to show a specific complaint detail (simulated)
        function showComplaintDetail(id) {
             navigate('complaint-detail', {id: id});
        }
