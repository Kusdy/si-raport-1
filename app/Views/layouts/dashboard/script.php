<!-- Core JS -->
<!-- build:js assets/vendors/js/core.js -->
<script src="<?= base_url() ?>template/assets/vendors/libs/jquery/jquery.js"></script>
<script src="<?= base_url() ?>template/assets/vendors/libs/popper/popper.js"></script>
<script src="<?= base_url() ?>template/assets/vendors/js/bootstrap.js"></script>
<script src="<?= base_url() ?>template/assets/vendors/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="<?= base_url() ?>template/assets/vendors/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendorss JS -->
<script src="<?= base_url() ?>template/assets/vendors/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="<?= base_url() ?>template/assets/js/main.js"></script>

<!-- Page JS -->
<script src="<?= base_url() ?>template/assets/js/dashboards-analytics.js"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<script>
	$(document).ready(function() {
		var $table = $('.table');
		var $tbody = $table.find('tbody');
		var $rows = $tbody.find('tr');
		var totalItems = $rows.length;
		var itemsPerPage = 5; 
		var currentPage = 1;

    	// Fungsi untuk menampilkan halaman tertentu
		function showPage(page) {
			$rows.hide();
			var startIndex = (page - 1) * itemsPerPage;
			var endIndex = startIndex + itemsPerPage;
			$rows.slice(startIndex, endIndex).show();
		}

    	// Inisialisasi tampilan awal
		showPage(currentPage);

    	// Fungsi untuk mengubah jumlah item per halaman
		$('#items-per-page').on('change', function() {
			itemsPerPage = parseInt($(this).val());
			// Reset halaman ke 1 ketika mengubah jumlah item per halaman
			currentPage = 1; 
			showPage(currentPage);
			createPaginationItems();
		});

    	// Fungsi untuk menghitung jumlah halaman yang diperlukan
		function calculateTotalPages() {
			return Math.ceil(totalItems / itemsPerPage);
		}
		
		function createPaginationItems() {
			var totalPages = calculateTotalPages();
			var $pagination = $('.pagination');
			// Menghapus item-item pagination yang ada
			$pagination.empty(); 

        	// Tambahkan tombol "Previous"
			$pagination.append('<li class="page-item"><a class="page-link prev" href="javascript:void(0);"><i class="tf-icon bx bx-chevron-left"></i></a></li>');

        	// Tambahkan tombol-tombol halaman
			for (var i = 1; i <= totalPages; i++) {
				var pageClass = (i === currentPage) ? 'active' : '';
				$pagination.append('<li class="page-item ' + pageClass + '"><a class="page-link" href="#">' + i + '</a></li>');
			}

        	// Tambahkan tombol "Next"
			$pagination.append('<li class="page-item"><a class="page-link next" href="javascript:void(0);"><i class="tf-icon bx bx-chevron-right"></i></a></li>');
		}

    	// Inisialisasi pagination item
		createPaginationItems();

    	// Fungsi untuk mengubah halaman saat tombol "Previous" atau "Next" diklik
		$('.pagination').on('click', 'a', function(e) {
			e.preventDefault();
			var $this = $(this);
			if ($this.hasClass('prev')) {
				if (currentPage > 1) {
					currentPage--;
				}
			} else if ($this.hasClass('next')) {
				if (currentPage < calculateTotalPages()) {
					currentPage++;
				}
			} else {
				currentPage = parseInt($this.text());
			}
			showPage(currentPage);
			createPaginationItems();
		});
	});

</script>