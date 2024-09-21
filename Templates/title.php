<header>
	<div>
		<?php 
		if (isset($_SESSION["role"])) { 
			if ($_SESSION["role"] != 'student') { ?>
				<a href="user_detail.php">
					<button title="User Detail" type="button" class="btn white round" style="background: var(--primary-color)">
						<i class="fa fa-user"></i>
					</button>
				</a>
		<?php 
			} 
		} ?>
		
		<button title="Help & Support" type="button" class="btn white round" style="background: var(--primary-color)">
			<i class="fa fa-info-circle"></i>
		</button>
		<a href="logout.php">
			<button title="Logout" type="button" class="btn btn-danger round">
				<i class="fa fa-power-off"></i>
			</button>
		</a>
	</div>
</header>
