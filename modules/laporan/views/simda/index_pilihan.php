<div class="box no-border animated fadeIn">
	<div class="box-header with-border">
		<div class="box-tools pull-right">
			<a href="<?php echo current_page(); ?>" class="btn btn-box-tool ajaxLoad show_process">
				<i class="fa fa-refresh"></i>
			</a>
			<button type="button" class="btn btn-box-tool" data-widget="collapse">
				<i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="maximize">
				<i class="fa fa-expand"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove">
				<i class="fa fa-times"></i>
			</button>
		</div>
		<h3 class="box-title">
			<i class="<?php echo $icon; ?>"></i>
			&nbsp;
			<?php echo $title; ?>
		</h3>
	</div>
	<div class="box-body animated zoomIn">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<?php
					$left									= null;
					$right									= null;
					foreach($results as $key => $val)
					{
						$output								= '
							<div class="panel panel-primary">
								<div class="panel-heading no-padding">
									<a data-toggle="collapse" data-parent="#' . $val['position'] . '" href="#collapse_' . $key . '">
										<div class="info-box ' . ($val['color'] ? $val['color'] : random_bg()) . ' no-margin">
											<span class="info-box-icon">
												<i class="' . $val['icon'] . '"></i>
											</span>
											<div class="info-box-content">
												<span class="info-box-number">
													' . $val['title'] . '
												</span>
												<span class="info-box-text">
													' . $val['description'] . '
												</span>
											</div>
										</div>
									</a>
								</div>
								<div id="collapse_' . $key . '" class="panel-collapse collapse">
									<div class="panel-body">
										<form action="' . go_to($val['method']) . '" method="GET" target="_blank" class="form-sm" dropdown-action="' . go_to() . '">
											'  . (isset($val['kegiatan']) ? $val['kegiatan'] : null) . '
											'  . (isset($val['skpd']) ? $val['skpd'] : null) . '
											'  . (isset($val['jenis_standar_harga']) ? $val['jenis_standar_harga'] : null) . '
											'  . (isset($val['standar_harga_pilihan']) ? $val['standar_harga_pilihan'] : null) . '
											'  . (isset($val['jenis_data']) ? $val['jenis_data'] : null) . '
											'  . (isset($val['tanggal_cetak']) ? $val['tanggal_cetak'] : null) . '
											<div class="row form-group">
												<div class="col-sm-12">
													<div class="btn-group btn-group-justified">
														<div class="btn-group" role="button">
															<button type="submit" name="method" value="preview" class="btn btn-primary btn-sm text-xs">
																<i class="fa fa-search"></i>
																' . phrase('preview') . '
															</button>
														</div>
														<div class="btn-group" role="button">
															<button type="submit" name="method" value="print" class="btn btn-info btn-sm text-xs">
																<i class="fa fa-print"></i>
																' . phrase('print') . '
															</button>
														</div>
														<div class="btn-group" role="button">
															<button type="submit" name="method" value="download" class="btn btn-danger btn-sm text-xs">
																<i class="fa fa-download"></i>
																' . phrase('download') . '
															</button>
														</div>
														<div class="btn-group" role="button">
															<button type="submit" name="method" value="export" class="btn btn-success btn-sm text-xs">
																<i class="fa fa-file-excel-o"></i>
																' . phrase('export') . '
															</button>
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						';
						if($val['position'] == 'left')
						{
							$left							.= $output;
						}
						else
						{
							$right							.= $output;
						}
					}
				?>
				<div class="row">
					<div class="col-md-6 col-md-6 col-xs-12">
						<div class="panel-group" id="left">
							<?php echo $left; ?>
						</div>
					</div>
					<div class="col-md-6 col-md-6 col-xs-12">
						<div class="panel-group" id="right">
							<?php echo $right; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>