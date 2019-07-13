<?php 
header("Content-type: application/vnd.ms-word; charset=utf-8");
header("Content-Disposition: attachment;Filename=reporte_word.doc");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
	<html>
	<head>
		<title>Hojas de Ruta</title>
		<style type="text/css">
			body{
				font-family: serif;
				font-size: 59%;
				padding-top: 55px
			}
			table, tr, td{
				border-collapse: collapse;
				padding-left: 10px;
			}
		</style>
 	</head>
	<body>
		<?php for ($x=0; $x < count($result['hoja']); $x++): $row_accion=$result['hoja'][$x]['acciones'];$destinos=$result['hoja'][$x]['destinos'];$resp=$result['hoja'][$x];?>
			<table id="header" width="100%" border="1" style="margin:0">
				<tr>
					<th width="20%"><img src='data:image/jpg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAAA2AAD/4QMraHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjMtYzAxMSA2Ni4xNDU2NjEsIDIwMTIvMDIvMDYtMTQ6NTY6MjcgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDUzYgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjVBNUI1NEU3ODg2ODExRTk4NDdDQzNEOUIwMUE0Q0IxIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjVBNUI1NEU4ODg2ODExRTk4NDdDQzNEOUIwMUE0Q0IxIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6NUE1QjU0RTU4ODY4MTFFOTg0N0NDM0Q5QjAxQTRDQjEiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6NUE1QjU0RTY4ODY4MTFFOTg0N0NDM0Q5QjAxQTRDQjEiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7/7gAOQWRvYmUAZMAAAAAB/9sAhAAHBQUFBgUHBgYHCwcGBwsMCQcHCQwODAwMDAwOEQwMDAwMDBEOERESEREOFhYXFxYWIB8fHyAjIyMjIyMjIyMjAQgICA8NDxwSEhweGBQYHiMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyP/wAARCABYAJYDAREAAhEBAxEB/8QAsQAAAgMBAQEBAAAAAAAAAAAAAAYEBQcDAgEIAQEAAgMBAQAAAAAAAAAAAAAAAQIDBAUGBxAAAgECBAMEBQcIBgsAAAAAAQIDBAUAERIGITETQVEiB2FxQhQIgZGhMnKyI7HBkqJzNBU1UmKCM5Oz0cLSQ4Oj0ySEFhcRAAIBAgQEAwQIBgMAAAAAAAABAhEDIRIEBTFBURNxwTJhsSIz8IGRUnIkNAah0eFCYiOCwkT/2gAMAwEAAhEDEQA/AP0jgAwAYARN3VW9dsyyXiwwLerO2b11nkz60B5tLSyLmxQ82QhsuY4crxo+JV1RQW74h9pzIPf6GsopOTBVSZAftKyt+riztMjOi1Xz18uiuZrJ1PcaWbP6FxHbZOdEOt+IHY8CH3aOsrH9lUhEYP8AalZfyYdpkZ0Jl5+Iq9z6ks1rholPAS1LtO/r0r01H04urSIcxIuPml5gXBiZ75PGp5pTaYF/5QU/Ti6giuZlKLvuKskzWuramTPPNZZpDn8hOJoiKlxQXzzLt+T0dTd4lHZpndPlV1ZcQ0iasdtvefm5LbMkG6KMVtPnk06R+71Kjv0nTG/qyX14o7S5FlM3Pb25LNuK2pcbRUrU0z8Gy4OjdqSIeKsO44wtNF06lpiCQwAYAMAGADABgAwAYADnkcuB7DgDGd3UPlrX3iW37xo223fWzaK6QZxwVaZ5LMkoVo2z9oSLmp4Z9uMsa8ijpzKF/Iehrh1LBuulrIW4qHVXOX24ZCP1cW7nVEZDmvw57lz8V4ogveElJ+bIYd1DISl8irBbl6u4d2xU6DiyosUPD0PNI33cO4+SGQFrvIPbH7vTybirE5OytUDMemXpwfMMKSY+FHyf4hFpU6Nj23DSwjgollCj/DhRQP0sO11YzkE/ETu/PhbbeB3aZz9PVw7SIzslQfEFJUjo33blNWU7cGWJ+z7EyyA/Ph2ujJzjTsi8+WtwvUdbtac7fu82S1dokHSiq07U6OZiZh7DRnUO7LMYrJOmJKa5GtYxFwwAYAMAGADABgAwAYAMAU+59sWPcltehu9KKmEZtEy8JY2y+tE44q35e3EptENVMCuPkjcJkeu2fcobxRhivRdhBUxspyaOTkuteRB0n0Yzq51MeToKlZsjzCoyVqLPcQBwJjWSVf0oi4xbMiKMgps7ds8mS2KvkkPfSzE/OVxOZEUZd23yi8w68jTZ3pkPN6t0hA/ss2v9XFXNE5WOlB8P6UsIqdz7ghooRxdKcAAegz1GkfqYq7vQtkO72L4erTmlVc2uEq89M802Z/8AFVUxFZsUiRnr/hzPgFDUDs1qtb/t4mkx8J4/9Z8iLyQls3BNaapj+H1pHRQ3Z+9J+R8KyQpE1TZcO6LVHHbLpWpfrWy522+RH8QKOUVUubZ8PqyKx7j2YxyoyyqOGKFgwAYAMAGADABgAwAYAMAZ3vny0qLjVvf9rV72TcRH4zxO0UVVkOHW0cm/rZH0jGSM+TKuPQy64eYnnJtWX3W8sy6TkslXTRuj5dqTxhVf9LGRQiymZo4//fd/FeHuXr93b/qYdpDOysuHnJ5iVyFDdfdUPZSxRxn9PJm+nEq2iMzE6uuNwuVR1K+qmrahjwaeRpWJ9GonF6EDBZfLbfF6CtRWaZYW4ieoAp48u8GbTn8gxVzSJUWONJ8PG7pUDVNwoqYnmgMspHzIo+nFO6icjJLfDnfQMhe6Qt2KYpB+c4d1E5Dta/Ljzf2XP7zt+rp6yEHVJRRTHpSgcw0E4jXP0qQfTg5xfEZWjWtn7v8A47C9PX0UtpvtIAa611ClWAPASwkgdSJjyYcuRxilGhdOoy4qSGADABgAwAYAMAGADAHxlVlKsAVIyIPEEHAGX7uqt8bOEtRRUqbm2k+ZkoqlS9RRrzKdQameIeyWVtPI9+MkaPxKOqEdfMPyguJ6l12X7vI3FmpUhYZ+uNoD9GL5JdSuZdCRHuvyAjyddtzlh7LQavvzEYZZ9SaxJP8A9q2NaFy27tPQ4+q5SCm+cxiVsR22+LGZC1efPjfNfqWjaC1RHhlTx9STL9pNq+hRiytohzYl3Ddm57g2dfeayo1ey9RIF+RAQv0YuoorU80ll3PXeOkoK+pB5PFDO4/SAOFUKF9QUfmxaT1KGnvdKF7EjqSvyoQyn5sVeVk4jnYPOu+2ysgi3ra2mSIlUuHQMFVEG4MdDBVcd4XT8uKu2nwLKXU3a03e23i3w3G2VCVVHONUc0ZzB7we0EdoPEYwtUMiZMxADABgAwAYAMAGADABgAwAk7k8o9kX+R6iaiNFWPxapom6LMe9kyMbH0lc8XU2irimItX8N9OWJor+6L2LPTK5H9pHT8mL90rkI8Pw3VGr8bcKhf6lKSf1pcO6Mhe234eNqwENcK+rriPYUpAh+RAW/WxDusnIh7suxNoWMD+G2inhkH++ZOpL/iyan+nFHJsskhgxUkMAcqimpqmJoamFJ4m4NHKodT61YEYAp7RtG02SvlqrMnuEFVmaugi/d3f2ZVi5RuOWa5AjmOWUuVSEi9xBIYAMAQ7ndaK2QdaqfSDwRBxZj3KMa2p1duxHNN/1LQg5PAVp/MB9R93oho7DI/H5lH58cK5+4HX4YfazYWm6sl2reorKuGklpCjzMEV0fUAT3ggY2NJvfdmoONG+jKzsUVajVjvGuGADACbu293SguUcNJUGKMxK5XSp4lmGfiB7seb3fXXbV1RhKiy+z2m1ZtqSxGHb9TPVWelqKh9c0iku+QGZ1EdmOxt92VyxGUnVswXElJpC3VbwuD3RaOCNIIhOIWY+NmAfSefAZ+rHFu7zcd3JFKKzU6viZ1YVKsv91V9TbttXavpGCVVJSTzQMQGAdIyynSeB4jHp4rE1GQLbea2morb/ABBKmWe41nuoNYkEMiAwvKG0U2pCv4XDt44loVPB3fUzw202+3ioqLnNWwRJJOI0T3NpFZ2kCPwfp8Ml7cMoqRLhvWpltMMtqoi9TVWqa7N1ZVi6EaKoyUlXDyB35cBw4nEqJFT1U71Nto7R1ohWST09HLXsjP1YxUskKylEiZAC7H67pnkQM8MtRUtqe+VNXXXOGClAorazU81W0uUhnESzERw6G8IEg8TMOPZlitCalLPuq4tbLWlBE89VJbo7xWSSyRRsaeMIXjDdMoZJScuCqB3rwxbKRUkXHfDU469LbzU0MdBT3aonaURMsE7soVI9LanAUtkSB6cQok1GaukeKiqZEOl0idlPcQpIxgvycbcmuKTLRWJm43XuDST74c8s/qJ6P6uPGLdtTT1fwX8je7Mehz3FcJK+7TyZlo42MUC9yqcuHrPHFNx1DvXm+SwRNqOWI5WbadupaZGq4VqKpgDIZBqVSfZVTw4Y9JototW4LOs0/aas7zbw4E1duWhKuGrhpxDNC2pTH4QeGXFeXbjZW22VNTjGkl0K92VKFBd943GiuVTSxQwtHC2lSwbM8AeOTDvxydZvN21dlBKNF4maFhNVGyWdkonnAGtYjIB2ZhdWO/KbVty9lTWSxoKtk3fca+509JLDEscpOpkDZjJS3DNj3Y4Oh3i5euxg1Gj8ehs3LCiqlfvv+cRfsF+82NTfvnL8Pmy+n9JZR3iotO07bPAiOznQRJnllm57CO7G5HWS0+jtyik64Y/WY3BSm0xO96f3z3vIdTq9bT2atWvL1Y873Xnz8618zaphQcqK+y3m0Xda6mhkhigIaDJikisralcE8jlj1Gj3S5dt3JNKsFVfxNS5ZSaXUi2+7DcdVFa7nRwSUv8AeqFDhleMZoyNqzUjvGKbdu9y9dUGklRi7ZUY1LC+Ci29Q29rdQQItLJIlKhUhYhKrGTphSMtWfHG7umunp4KUaOr5lLNtSZBtVLaL9aHWvtdM0VsVoqSFVYIsbJ4oz4uKNkM15HFNv3G5etzlJJOP8hdtKLSKdLpaayoimudppnWmhVIdCuDlCdcEfFtJCvxXMHTzGObY/cE6/GlSnLqZZaZciy2/Xpc9zNUzUcCTzROJZY1YMyhdID+LJuHDMjPLGfbt1u372SVMtGRdsxiqkbcNTSSVK2pLPTzQWwe70wZHcrHpUaAEK+AgDNTmDlxxXV7zehdlCCWD8RCxFpNnMbj1yyrc7dBURzxLS1K6CjmFSWWPictILHIZY1rW/Xov40mvsZd6eL4D1UVMNVZZ6mFtUUtPIyH0FDj0Fy7G5Yco8HF+41kqSoZOPqN9n84x4FcDokmZWprg6yDxQTHWPstxxmmnC46/wBsvMqsUa5FKksaSxtqjcBkYciCMxj6DGSkk1wZzWqHrFgZZub+e132/wDVGPCbn+on4nQtelGjVLqLPK5PhFOxz9GjHsrrXZb/AMfI0l6jPNp/z+i9bfcbHj9p/UQ+nJm5e9LJ++/5xF+wX7zY29++cvw+bK6f0jTtdVbb9CGAPgPMZ+0cd3a0npoeHma931MQAB/HQMuHveWX/Fx5L/0f8/8Asbn9v1GkXlEWz1+lQM4JM8hl7Jx7PWJKzOn3X7jRh6kIuzCBf4fSkgH6OPLbL+oXgzbv+kvd/sBQUi58TMSB6Ah/046v7gf+uK/y8jDpuLI+zP5RdPWf8vGHZfk3PpyLX/UhYs1GlbcqWlfgkrgPlz0gaj9Axw9HZV27GD4NmxOVE2alDRW+jXXFBHCI1PjVQCFHPxc8e6hYt21VJRoc9ybFGfedQ9U0NoolPUY5MVLPIf6WhMsefub1JzpZgsftf1I2VYVPiZT3+qu1S8MlzpBTyAMqPoKFxw4HMnPLHO3C7em07scr8KVMltRXBjTYCTs6TM55R1AHq8WO7t7/ACT8JeZr3PmGfD6jfZ/OMeRXA3R23XtieedrhQJ1Gf8AeIB9YkcNad/pGPTbttcpy7ltV6rzRq2bqSoygt+4rval93Rh01P9xOp8Pq5MMcnT7je06yrh0ZllajLEtLduu8V11pIWZVheVRIkScwe8nUcb2m3a/dvRi6ZW8aIpKzFRZF3lbZ6e6yVWgmnqcmWTsDAAMp+bPGDedNKF5zp8Mi1iVY0OFNc79c4I7RDIZIiAhyUZ6B/Tf8AojGK3qtRfirMXVeXtfQlwjF5j5tYEbgpB3M/3GxG1L8zH6/cxe9LJu+8/wCMRfsF+82NrfvnL8Pmyun9I17W/kFF9g/eOO9tX6eHh5mte9TEG9UtRb7xPrUqRKZoXI4MC2tSO/Hk9balZvuv3qr3m5balEb7NepNw01dSyxLDlEEzUk59QMpPH1Y9Fota9ZGcGksPfU1p28jTEj/AL6014Jzgq6duBI+Tt4EHHl/9mnufdnE28JL2Eq4VF4ulObjWEtTwlYozp0rm/YgHPlxONjUXL1+Pdn6Vh9vQrFRi6Ivtmfyi6es/wCXjq7L8m59ORhv+pFFtYH+O0PD2j9xscrav1EPpyM170s0qugaooqiBTk0sboD3FlIx7W/DPCUVzTRoRdHUzCgrKux3LqPCBNGGjeKTMcDzyP58eH096eku1a+JYUZ0JRU0d73XXK5iK4VMXSpiTFToM8uHiYjPn68ZNdfu36XJKkeCK24qOCGfbxB2hMO0JUg/rHHd25/kn4S8zBd+YIIB0Nw9n84x5JcDcGzy+3LdLnT1Ul0qDUCGmp6gkLG2h3MvVX8BF0nwD8JgXHPPjj6ZJUOTFne37tNzsF4uj0MM0lsUvAuYKzKYFqEB+uVPi0ntHcDwxSdmLeKTJUmTf45V0VmudTJRwLV26oFKwiLLAQ/SImZtOpURZs34clOEbcVwVA5M+X3ck1DQULr7pN74krvVyORSfhR9TQrgNmZeSfLz5GcieDFaF7bWjloaeoWm91NRGkrQFQrIXUNobIDiueRxSMIxwSoTWpR7buL1tbVGruIWujmqY2smmJOhHHLoifTp6zZoFbXq0nVw7MXcUuRCZxsO7Ku6UVzq5qBIVoozLEnUVnBHUzhmQEsjr0+0Dny4YmUEEz1R7hvNTZrtIaaGC5UNOlRAE1vETNTidFIIViVPhOXPDKkKnc3arqKTb4SOmq5LqR15iSYVVYWmkePINmToyAOKytxlxQTZ4bccdPu2CwU9PH0pc1mZRodH6LVCkD2l0rlmBlmeefDCNqMVgqByxJtnd62S6CsAnFPXSxQdRVOmMJGQq8OWZOInbjLikyU2VO5dxVlHdKe103Rp0MtvJZ2IlmWoqulIlOmkghETx+huzF4wVCGyVLuSrTdq2OOiT3cCPqTNIqOwkjd+pEjEF1QppOQPyZcYUVQVxJW7q2pt23K+tomEVTCimOTJfDm6qT4wy8jzIyxEYqobKu37lr02oblKVqahat6UTyFREqGp6CTSyxKEdEQgs6KAcuzFmsSK4HSS7T3C1WysMSJJLcY6WRkAkjliWdomeJnXPpyBdQPccUlai3ikyVJk2S41iS35aeD3iS3LG1LTuclcmASaEyXNczw7eOLZVgKnGLcElZZqS5wRGOnrK6CKl0nSz08lQsQkcMpy1jjl3duGWmAqE25Qm7qewpCjpICsznwujdF6hWAJ8S5JlwGWZ558MMipUVxP//Z'/></th>
					<th width="60%"><h3 align="center" style="margin:0px;font-family:Arial, Helvetica, sans-serif;font-weight:800;color:#535353">CASA NACIONAL <br>DE LA MONEDA</h3></th>
					<th width="20%"><img src='data:image/jpg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAAA2AAD/4QMraHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjMtYzAxMSA2Ni4xNDU2NjEsIDIwMTIvMDIvMDYtMTQ6NTY6MjcgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDUzYgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjIyNTg4RUJEODg2ODExRTlBODNBOUY3RjJCQTFGREM4IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjIyNTg4RUJFODg2ODExRTlBODNBOUY3RjJCQTFGREM4Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MjI1ODhFQkI4ODY4MTFFOUE4M0E5RjdGMkJBMUZEQzgiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MjI1ODhFQkM4ODY4MTFFOUE4M0E5RjdGMkJBMUZEQzgiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7/7gAOQWRvYmUAZMAAAAAB/9sAhAAHBQUFBgUHBgYHCwcGBwsMCQcH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'/></th>
				</tr>
			</table>
			<table class="table-hover" width="100%" border="1">
				<tr>
					<th  rowspan="4" width="20%">
					</th>
					<th  width="60%" colspan="3" rowspan="4"><h4 align="center">HOJA DE RUTA</h4></th>
					<th width="20%" style="background:#ececec">No DE REGISTRO</th>
				</tr>
				<tr>
					<td style="text-align:center"><?php echo $resp['id']?></td>
				</tr>
					<tr>
					<th style="background:#ececec">TRAMITE</th>
				</tr>
					<tr>
					<td style="text-align:center"><?php echo $resp['tramite'] ?></td>
				</tr>
				<tr>
					<td >PROCEDENCIA</td>
					<td colspan="3"><?php echo $resp['procedencia'] ?></td>
					<th style="background:#ececec">CITE</th>
				</tr>
				<tr>
					<td >REMITENTE</td>
					<td colspan="3"><?php echo "$resp[remitente]"; ?></td>
					<td style="text-align:center"><?php echo "$resp[cite]"; ?></td>
				</tr>
				<tr>
					<td>CARGO REMITENTE</td>
					<td colspan="3"><?php echo $resp['cargo_remitente']?></td>
					<th style="background:#ececec">FECHA CITE</th>
				</tr>
				<tr>
					<td>ADJUNTOS</td>
					<td colspan="3"><?php echo $resp['adjunto'] ?></td>
					<td style="text-align:center"> <?php echo "$resp[fecha_cite]"; ?></td>
				</tr>
				<tr>
					<td >N° DE HOJAS</td>
					<td colspan="3"><?php echo $resp['num_hojas'] ?></td>
					<th style="background:#ececec">FECHA REGISTRO</th>
				</tr>
				<tr>
					<td >TIPO DE DOCUMENTOS</td>
					<td colspan="3"><?php echo $resp['tipo'] ?></td>
					<td style="text-align:center"> <?php echo "$resp[fecha]";?></td>
				</tr>
				<tr>
					<td >REFERENCIA</td>
					<td colspan="4"><?php echo $resp['referencia'] ?></td>
				</tr>
				<tr>
					<td rowspan="2">AREA DE DESTINO</td>
					<td rowspan="2"><?php $aux=0;while ($aux<count($destinos)){echo $aux==count($destinos)-1 ? $destinos[$aux]['nombre']:$destinos[$aux]['nombre']." - ";$aux++;}?></td>
					<td>NOMBRE</td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td >CARGO</td>
					<td  colspan="2"></td>
				</tr>
				<tr>
					<td >GESTOR VC</td>
					<td  colspan="4"><?php echo $resp['usuario'] ?></td>
				</tr>
			</table>
			<?php for ($i=0; $i < count($destinos); $i++): ?>
				<table width="100%" border="1" style="page-break-inside: avoid;">
	        		<tr style="background:#e8e8e8">
						<td colspan="2">ACCION</td>
						<td >Destinatario</td>
						<td colspan="3"><?php echo $destinos[$i]['nombre']?></td>
	        		</tr>
	        		<tr>
						<td width="30%"><?php echo $row_accion[0]['nombre']?></td>
						<td width="2%"><?php echo $row_accion[0]['estado']==1 ? "x":"";?></td>
						<td width="15%">Plazo respuesta</td>
						<td width="20%"><?php echo $resp['plazo']." Dias"?></td>
						<td colspan="2" rowspan="<?=count($row_accion)?>" width="33%" style="vertical-align:text-top"><h3 style="text-align:center;font-weight:800;color:#000;margin-top:0;font-size:1.2em">PROVEIDO<small style="color:#000;font-weight:300;font-size:.9em"><br><?=$resp['proveido']?></small></h3></td>
					</tr>
					<tr>
						<td><?php echo $row_accion[1]['nombre']?></td>
						<td><?php echo $row_accion[1]['estado']==1 ? "x":"";?></td>
						<td colspan="2" rowspan="<?=count($row_accion)-1?>"></td>
					</tr>
        			<?php for ($j=2; $j < count($row_accion); $j++):?>
						<tr>
							<td><?php echo $row_accion[$j]['nombre']?></td>
							<?php if($row_accion[$j]['estado']==1):
								echo '<td>x</td></tr>';
							else:
								echo '<td></td></tr>';
							endif;
					endfor;?>
					<tr>
						<td>Cordinar con:</td>
						<td colspan="3"></td>
						<td width="10%">Con copia a:</td>
						<td width="20%"></td>
					</tr>
					
				</table>
			<?php endfor;?>
			<pre><br clear=all style='mso-special-character:line-break;page-break-before:always'></pre>
		<?php endfor;?>
 	</body>
</html>
