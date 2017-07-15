<?
	function print_calificacion($valor)
	{
		$result = "";
		$promedio=number_format($valor,1);
		$result = "<span class='label badge-warning badge'>";
		for ($i = 1; $i <= 5; $i++) 
		{
			if($i < $promedio)
			{
				$result .= "<i class='fa fa-star fa-2x'></i>";
			}
			else
			{
				$temp = $i - $promedio;
				if($temp < 1 && $temp > 0)
				{
					$result .= "<i class='fa fa-star-half-o fa-2x'></i>";
				}
				else
				{
					$result .= "<i class='fa fa-star-o fa-2x'></i>";
				}
			}
		}
		$result .= "</span>";
		return $result;
	}
?>