<?
	function print_calificacion($valor)
	{
		$result = "";
		$promedio=number_format($valor,1);
		$result = "<span class='label label-warning'>";
		for ($i = 1; $i <= 5; $i++) 
		{
			if($i < $promedio)
			{
				$result .= "<i class='fa fa-star'></i>";
			}
			else
			{
				$temp = $i - $promedio;
				if($temp < 1 && $temp > 0)
				{
					$result .= "<i class='fa fa-star-half-o'></i>";
				}
				else
				{
					$result .= "<i class='fa fa-star-o'></i>";
				}
			}
		}
		$result .= "</span>";
		return $result;
	}
?>