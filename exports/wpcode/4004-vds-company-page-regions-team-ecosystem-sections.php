/**
 * VDS - Renders the regions + team + ecosystem sections on the Company page
 * (ID 16) and nowhere else. Live from 10 Sep 2026. Section order is CSS only.
 * Deactivate this snippet to revert the Company page to its pre-10-Sep state.
 */

add_action( 'get_footer', function () {

	if ( is_admin() || 16 !== (int) get_queried_object_id() ) {
		return;
	}
	static $done = false;
	if ( $done ) {
		return;
	}
	$done = true;

	$upload = 'https://vietnam-directsourcing.com/wp-content/uploads/';

	// name, role, region key, region label, bio, photo (empty = placeholder)
	$team = array(array( 'Rod', 'Sourcing Manager', 'all', 'Nationwide', '2026/09/vds_team_rod.png' ),
		array( 'Minh', 'Technology Specialist', 'all', 'Nationwide', '2026/09/vds-team-minh.jpg' ),
		array( 'Tho', 'Logistics Specialist', 'all', 'Nationwide', '2026/09/vds-team-tho.jpg' ),
		array( 'Thao', 'Sourcing Specialist', 'central', 'Central', '2026/09/vds-team-hien.jpg' ),
		array( 'Telly', 'Sourcing Specialist', 'north', 'North', '2026/09/vds-team-telly.jpg' ),
		array( 'Tam', 'Sourcing Specialist', 'north', 'North', '2026/09/vds_team_tham.png' ),
		array( 'Cassie', 'Sourcing Specialist', 'south', 'South', '2026/09/vds-team-cassie.jpg' ),
		array( 'Kim', 'Sourcing Specialist', 'south', 'South', '2026/09/vds-team-kim.png' ),
	);

	$linkedin = array( 'Rod' => 'https://www.linkedin.com/in/roddouglassmith/' );

	// renewable energy is sourced in the South (Rod, 26 Oct 2026); link to its guide only once that article (Ep 60, post 4298) is live
	$renew = ( 'publish' === get_post_status( 4298 ) )
		? '<a href="/how-to-source-solar-renewable-energy-products-from-vietnam/">renewable energy products</a>'
		: 'renewable energy products';

	$regions = array(
		array( 'North',   'Hanoi, Bac Ninh and Hai Phong', '<a href="/how-to-find-electronic-component-manufacturers-in-vietnam/">Electronic components</a>, <a href="/how-to-find-steel-metal-fabrication-suppliers-in-vietnam/">steel and metal products</a>, and <a href="/how-to-source-construction-materials-from-vietnam/">construction materials</a>, from the industrial belt around Hanoi and the northern ports.', 'north' ),
		array( 'Central', 'Da Nang, Hue and the Central Highlands', '<a href="/organic-fabric-suppliers-vietnam-gots-oeko-tex/">Organic textiles</a>, handicrafts, and <a href="/sourcing-biodegradable-coffins-in-vietnam/">funeral and memorial products</a>, from the central coast inland to the highlands.', 'central' ),
		array( 'South',   'Ho Chi Minh City and the Mekong Delta', '<a href="/find-bamboo-suppliers-in-vietnam/">Bamboo and wood products</a>, <a href="/how-to-find-furniture-wood-manufacturers-in-vietnam/">furniture and home goods</a>, <a href="/how-to-find-biodegradable-compostable-packaging-manufacturers-in-vietnam/">biodegradable plastic and paper</a>, <a href="/healthcare-procurement-vietnam/">health and personal care</a>, ' . $renew . ', and <a href="/how-to-request-an-fmcg-quote-from-vietnam/">FMCG and consumer goods</a>, from the Binh Duong and Dong Nai manufacturing belt.', 'south' ),
	);

	$logos = array(
		array( '2026/10/Odoo-Inventory.png', 'Inventory', 48 ),
		array( '2026/10/Odoo-Manufacturing.png', 'Manufacturing', 48 ),
		array( '2026/10/Odoo-Purchase.png', 'Purchase', 48 ),
		array( '2026/10/Odoo-Quality.png', 'Quality', 48 ),
	);

	$svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1250.0 1628.5" class="vds-vn-map" role="img" aria-label="Map of Vietnam showing the northern, central and southern regions with Vietnam Direct Sourcing specialists in Hanoi, Da Nang and Ho Chi Minh City."><rect width="1250.0" height="1628.5" fill="#EAF0F6"/><path d="M319.6,1529.5 315.2,1528.9 319.3,1528.6 319.6,1529.5Z M-22.4,1512.4 -38.5,1501.7 -21.6,1500.0 -22.4,1512.4Z M-60.0,1503.8 -59.0,1505.9 -60.0,1507.9 -60.0,1503.8Z M-30.7,1487.8 -23.6,1479.2 -22.0,1491.8 -30.7,1487.8Z M-48.2,1449.9 -44.0,1447.9 -46.7,1451.0 -48.2,1449.9Z M298.3,1393.4 300.6,1394.5 304.4,1396.7 301.8,1400.5 298.3,1393.4Z M288.5,1380.4 302.0,1383.1 297.2,1389.1 288.5,1380.4Z M273.0,1327.5 267.7,1310.2 271.8,1309.4 273.0,1327.5Z M269.0,1299.3 277.7,1305.7 272.3,1309.1 269.0,1299.3Z M223.0,1290.1 231.4,1281.2 229.8,1294.5 223.0,1290.1Z M214.7,1268.6 221.5,1267.0 219.2,1270.9 214.7,1268.6Z M205.5,1237.0 201.8,1253.4 195.3,1232.6 205.5,1237.0Z M46.8,1174.7 50.9,1176.4 48.2,1179.1 46.8,1174.7Z M1310.0,-62.4 1310.0,185.2 1298.3,169.8 1304.2,182.6 1302.2,184.0 1303.3,188.7 1295.6,196.6 1295.7,199.1 1296.7,200.2 1296.5,202.4 1281.4,200.6 1280.4,164.8 1270.6,155.8 1262.2,154.6 1278.5,186.7 1261.2,223.5 1254.1,209.1 1225.2,233.7 1206.5,208.5 1204.3,238.5 1137.5,229.3 1148.4,248.0 1133.8,258.7 1072.9,256.5 1077.4,263.9 1032.6,275.9 1033.2,288.9 1019.0,289.3 1015.8,290.8 1014.7,292.6 1018.4,282.2 1008.2,269.7 1011.5,293.0 985.4,312.5 987.0,328.5 1007.4,330.7 1000.4,346.7 1022.1,371.8 962.6,392.4 956.3,374.1 971.6,369.4 936.5,318.9 966.5,261.9 937.8,260.0 930.9,233.2 924.7,259.7 886.1,270.0 885.2,247.8 861.1,248.0 855.1,240.5 859.3,232.4 854.9,229.3 844.5,249.4 825.4,216.4 817.7,253.6 804.0,237.7 792.2,259.9 794.1,244.9 707.8,248.2 673.7,213.4 639.1,209.8 626.9,161.2 653.1,123.7 557.8,111.8 503.4,63.4 451.6,91.9 442.4,121.7 380.1,123.8 366.6,154.4 335.9,125.2 322.8,145.7 303.5,123.7 272.6,161.0 215.9,126.8 182.8,167.5 236.6,244.9 252.8,225.7 266.5,236.6 250.9,285.6 280.8,324.6 339.3,349.4 392.6,321.2 433.0,348.6 407.1,371.0 466.4,407.4 433.3,455.1 373.0,447.1 380.3,468.7 356.6,490.2 482.6,552.3 487.4,592.2 518.7,606.6 544.3,659.7 624.3,732.3 639.2,787.7 656.9,777.9 714.7,825.8 686.0,854.6 737.8,908.6 715.5,933.3 724.4,972.2 702.7,1027.7 731.4,1088.7 716.9,1142.4 727.0,1198.1 713.7,1220.7 611.5,1250.3 614.6,1281.8 574.3,1270.4 553.7,1283.5 555.6,1322.6 587.7,1347.9 587.8,1372.8 547.9,1348.9 504.2,1367.3 480.0,1355.9 455.9,1400.9 413.3,1412.0 356.4,1383.2 333.6,1406.3 319.5,1392.0 340.8,1345.8 319.5,1333.9 312.7,1364.1 282.8,1366.6 283.5,1304.7 229.9,1226.3 228.8,1244.4 199.3,1229.2 206.2,1209.7 148.9,1175.0 55.6,1181.5 70.0,1093.3 29.3,1081.3 -34.9,1112.5 -18.7,1139.2 -27.5,1229.2 -60.0,1287.9 -60.0,-62.4 1310.0,-62.4Z M-59.2,1527.4 -41.7,1538.6 -33.0,1604.0 -7.9,1619.5 8.1,1691.0 -60.0,1691.0 -59.2,1527.4Z M927.2,607.7 838.5,571.5 833.1,492.4 900.4,448.4 886.4,446.2 896.0,426.3 969.3,427.0 1007.1,406.7 1031.3,425.0 1038.5,399.1 1063.2,414.3 1074.2,453.7 1049.1,457.1 1011.2,555.6 927.2,607.7Z M1011.0,348.3 1018.2,351.3 1017.6,354.9 1011.0,348.3Z M1025.9,324.8 1034.4,319.0 1031.3,326.4 1025.9,324.8Z M990.9,314.0 995.1,316.1 990.2,317.4 990.9,314.0Z M997.9,308.5 1009.4,302.1 1025.2,305.8 1022.2,319.9 997.9,308.5Z M880.9,304.9 882.6,310.1 878.8,309.9 880.9,304.9Z M1012.7,293.4 1032.3,290.5 1026.9,302.6 1012.7,293.4Z M1154.2,243.9 1155.6,253.8 1150.3,253.6 1154.2,243.9Z M1235.2,246.0 1229.8,238.9 1235.6,237.8 1235.2,246.0Z M1247.7,252.6 1247.2,232.0 1257.2,231.6 1247.7,252.6Z M1282.9,221.7 1289.5,222.1 1283.2,225.6 1282.9,221.7Z M1291.4,217.6 1299.2,216.6 1296.0,220.8 1291.4,217.6Z M1289.9,203.9 1295.0,207.6 1288.4,212.4 1289.9,203.9Z M1310.0,207.6 1302.4,201.2 1310.0,200.4 1310.0,207.6Z M1295.9,197.6 1305.7,192.1 1299.2,202.4 1295.9,197.6Z M1307.0,183.9 1306.2,190.6 1303.2,183.7 1307.0,183.9Z M1270.2,161.3 1271.3,157.1 1271.2,161.3 1270.2,161.3Z" fill="#DFE4E9" stroke="#CDD5DD" stroke-width="0.7"/><path d="M184.4,167.2 195.1,165.1 218.4,127.6 255.8,145.2 272.1,162.5 286.3,152.1 303.6,125.3 322.8,147.4 335.3,126.6 366.6,156.2 380.9,125.1 396.0,121.6 396.2,131.4 407.0,136.7 428.3,120.5 443.1,123.1 456.1,110.6 452.7,93.0 460.9,85.3 494.0,76.9 502.8,64.8 525.4,87.3 527.4,97.8 542.4,99.1 557.2,113.4 583.4,105.3 598.2,118.7 622.1,110.8 652.1,124.9 641.3,147.0 630.5,145.2 625.4,160.9 626.4,171.9 635.7,174.3 639.5,184.9 638.3,211.3 645.5,206.6 672.9,214.7 672.0,226.6 692.1,238.5 700.3,236.2 707.7,249.9 715.4,243.7 723.6,251.2 748.5,242.9 774.1,259.9 766.8,260.3 764.4,267.0 762.3,257.4 754.0,262.8 748.1,257.7 745.2,270.5 733.6,271.1 731.3,281.5 710.3,278.3 715.7,282.8 712.5,281.3 705.6,289.6 713.8,285.5 707.4,293.1 707.6,309.8 692.6,313.0 689.5,319.0 677.0,317.0 687.7,308.9 675.2,313.3 675.4,309.8 673.2,309.2 671.6,316.7 656.4,313.2 658.0,323.6 653.2,318.8 648.3,318.8 654.5,315.0 649.0,309.1 630.5,308.4 634.0,315.1 639.8,318.6 646.8,318.3 638.8,325.8 636.0,324.5 632.7,324.2 632.8,321.1 632.0,320.1 631.0,320.1 632.4,324.1 637.4,327.1 645.3,328.0 641.6,332.6 651.3,346.2 625.2,337.2 641.0,346.8 629.6,347.5 633.1,354.1 622.0,360.0 628.0,358.5 629.1,366.9 626.9,366.6 623.4,369.4 630.3,369.8 627.3,386.8 623.2,383.6 622.0,383.4 626.2,387.8 619.4,394.1 605.7,394.5 591.2,415.7 590.2,415.6 591.6,410.7 591.5,407.7 590.1,404.1 588.4,402.1 589.6,416.2 581.1,416.2 581.8,414.7 581.9,411.7 580.6,416.2 467.4,416.2 464.3,397.3 438.4,393.6 441.1,381.1 432.2,373.2 408.2,369.9 416.9,360.6 425.1,362.5 434.7,348.5 400.1,322.8 379.3,315.1 373.6,322.0 350.6,328.0 339.3,347.8 315.6,330.3 308.9,334.5 287.0,328.1 266.8,304.0 261.9,288.0 252.4,285.3 260.0,280.7 264.7,265.4 258.0,266.3 270.0,251.8 267.6,235.2 256.7,238.2 252.2,224.1 251.2,236.7 237.5,243.7 230.8,215.9 220.6,212.1 221.5,205.1 193.8,182.9 184.4,167.2Z M632.8,311.5 636.8,313.5 639.4,316.6 632.8,311.5Z M675.2,342.3 661.7,331.6 665.7,325.0 681.4,333.2 675.8,331.1 677.8,339.4 675.2,342.3Z M654.7,331.4 659.1,331.3 660.3,332.6 656.3,334.4 654.7,331.4Z M703.8,327.5 708.7,330.1 708.7,333.7 704.7,332.7 703.8,327.5Z M646.8,325.5 647.3,323.1 648.9,322.1 648.4,325.0 653.5,328.8 646.8,325.5Z M648.3,319.6 657.4,328.3 654.8,331.3 654.9,328.3 648.3,319.6Z M703.7,323.2 709.5,326.4 703.2,324.8 703.7,323.2Z M659.2,320.5 662.9,321.1 665.5,322.1 659.2,320.5Z M705.0,322.1 715.8,315.6 712.5,320.6 708.2,322.3 705.0,322.1Z M706.3,319.9 705.0,318.9 709.3,316.3 706.3,319.9Z M672.6,314.7 676.8,316.2 671.4,317.0 672.3,316.3 672.6,314.7Z M645.9,316.4 640.0,317.1 638.4,313.8 640.2,313.8 640.8,315.2 645.9,316.4Z M723.9,308.0 721.9,320.6 709.9,323.6 719.4,316.8 723.9,308.0Z M642.7,313.4 644.3,312.5 646.9,316.2 643.7,315.6 642.2,314.1 642.7,313.4Z M708.5,307.9 712.8,292.1 718.4,293.4 716.1,283.6 723.9,292.5 731.5,289.6 708.5,307.9Z M717.5,331.8 717.9,324.2 721.4,324.3 726.3,315.6 717.5,331.8Z M743.8,310.9 748.0,315.7 744.3,318.4 743.8,310.9Z M751.0,312.8 756.7,309.4 751.8,314.2 751.0,312.8Z M726.7,315.5 729.4,304.2 733.5,299.4 728.2,314.3 726.7,315.5Z M719.6,308.2 725.6,300.1 728.3,299.7 726.3,304.8 719.6,308.2Z M740.7,281.0 752.4,275.2 745.1,280.4 740.7,281.0Z M771.2,270.9 755.0,277.0 759.2,273.5 753.2,274.4 771.2,270.9Z M767.2,267.2 769.5,261.8 777.3,260.9 767.2,267.2Z" fill="#D0D3D8" stroke="#16243D" stroke-opacity="0.45" stroke-width="1.1" stroke-linejoin="round"/><path d="M581.1,416.2 588.3,418.3 580.5,419.1 581.1,416.2Z M580.6,416.2 578.0,420.5 573.3,416.7 568.8,419.8 563.9,438.2 556.7,440.3 563.8,439.2 552.4,459.3 551.7,459.6 552.5,457.2 551.4,455.5 548.3,457.3 552.4,488.1 543.3,496.2 544.3,509.5 537.0,510.5 531.6,521.5 562.9,576.9 559.1,583.2 564.7,575.2 579.7,598.2 588.2,597.4 605.9,612.4 602.9,616.2 614.1,611.9 622.0,630.3 614.7,637.2 616.4,654.9 633.2,680.8 682.0,719.7 680.9,728.1 689.9,738.1 683.2,743.6 690.5,738.6 733.4,773.6 713.0,763.3 733.1,775.3 729.7,775.4 727.9,777.7 739.2,778.4 753.4,793.8 748.4,793.5 752.4,802.3 761.2,803.0 762.7,795.6 768.3,800.7 773.8,797.6 779.6,809.1 774.8,808.8 790.0,810.8 782.7,820.1 792.8,823.7 792.5,830.4 793.5,817.0 802.7,817.6 795.7,822.7 796.5,830.3 834.4,884.8 830.3,886.7 836.7,891.9 839.4,886.3 848.4,900.5 853.1,893.1 864.2,911.0 856.5,921.4 878.4,967.5 878.0,991.4 893.1,1027.2 887.9,1022.4 885.2,1022.7 900.2,1052.7 899.9,1064.8 896.5,1066.0 898.5,1060.8 895.6,1060.0 895.3,1052.9 893.7,1052.7 893.9,1050.6 893.2,1049.0 892.5,1048.8 893.2,1078.1 900.4,1085.4 899.2,1089.6 897.5,1089.3 897.8,1086.8 893.8,1082.4 893.4,1084.8 903.5,1096.4 900.0,1102.6 893.4,1094.1 892.1,1103.6 899.9,1106.7 898.6,1111.6 899.7,1114.9 895.1,1114.6 902.4,1118.0 901.8,1136.9 916.5,1157.2 906.4,1162.9 916.5,1180.2 914.5,1190.0 910.2,1177.6 907.0,1182.1 903.4,1180.0 908.5,1174.8 905.3,1165.7 889.6,1183.2 904.8,1207.1 899.2,1212.9 887.0,1200.0 884.4,1203.0 894.8,1217.2 888.8,1227.7 898.6,1261.6 890.7,1261.3 891.1,1250.6 883.4,1257.7 882.9,1267.5 889.6,1261.8 893.9,1277.2 883.4,1294.5 871.3,1287.2 875.5,1291.7 871.7,1300.8 558.3,1300.8 552.1,1291.8 556.8,1283.1 566.5,1285.7 574.3,1271.9 615.8,1283.6 612.4,1251.6 641.7,1252.0 649.1,1240.9 668.2,1239.7 686.8,1219.8 705.1,1214.0 713.4,1222.5 724.8,1211.9 729.3,1185.9 718.4,1142.6 733.6,1105.0 732.9,1088.2 716.3,1062.3 714.8,1040.3 707.3,1038.9 704.2,1027.8 707.9,1003.6 717.8,995.8 725.9,972.4 721.4,957.1 728.9,947.8 716.9,933.8 731.5,930.1 739.5,908.3 721.0,885.2 709.9,884.9 687.5,854.7 690.4,847.1 709.9,841.4 716.5,824.3 703.5,826.6 686.1,813.0 683.3,804.0 668.8,801.2 658.3,788.7 657.5,776.4 648.0,787.7 640.3,786.7 637.0,771.7 626.2,762.5 626.1,728.8 614.3,729.5 601.2,698.2 591.2,701.2 545.4,658.7 520.0,605.6 513.4,602.7 509.1,608.4 488.6,591.3 480.4,577.7 489.5,560.1 483.9,551.2 444.1,541.4 422.6,522.7 392.3,508.8 387.1,500.2 357.5,488.2 382.2,468.9 373.9,448.4 411.0,448.2 421.6,457.2 434.0,456.6 441.3,442.7 453.6,438.0 454.7,431.8 447.9,429.3 459.9,417.3 467.4,416.2 580.6,416.2Z M893.5,1225.1 902.3,1225.3 904.1,1228.7 898.8,1230.1 893.5,1225.1Z M900.7,1184.5 908.8,1183.7 911.8,1191.2 900.7,1184.5Z M818.8,836.3 824.3,837.0 824.5,840.6 818.8,836.3Z M740.2,776.9 762.5,795.6 755.7,795.9 743.8,780.9 733.1,773.0 740.2,776.9Z" fill="#969CA8" stroke="#16243D" stroke-opacity="0.45" stroke-width="1.1" stroke-linejoin="round"/><path d="M482.5,1586.3 485.0,1586.4 489.2,1582.5 489.0,1584.5 489.5,1585.5 493.0,1588.3 481.3,1600.1 458.5,1606.4 442.2,1602.3 452.9,1597.4 452.6,1591.7 455.2,1593.5 462.3,1593.4 467.3,1590.8 467.8,1588.0 476.1,1584.8 477.7,1583.6 482.5,1586.3Z M626.5,1594.7 635.9,1586.0 637.4,1586.5 631.7,1598.5 626.5,1594.7Z M586.7,1492.2 591.7,1497.6 593.4,1498.7 599.7,1500.8 597.4,1505.6 592.3,1506.4 578.1,1481.6 581.0,1483.5 586.7,1492.2Z M594.1,1497.1 586.5,1491.6 583.9,1487.1 594.1,1497.1Z M433.7,1475.4 435.1,1478.3 431.0,1478.0 433.7,1475.4Z M619.4,1466.5 622.7,1474.6 611.0,1461.7 619.4,1466.5Z M568.0,1468.6 558.5,1462.0 555.1,1458.1 563.5,1462.3 568.0,1468.6Z M591.2,1440.6 597.7,1449.7 588.6,1438.8 591.2,1440.6Z M371.3,1456.0 354.0,1417.6 363.2,1419.2 369.9,1409.9 378.3,1418.2 372.3,1448.3 375.8,1456.3 371.3,1456.0Z M626.6,1427.3 645.6,1432.3 618.2,1425.3 626.6,1427.3Z M634.0,1430.3 630.2,1430.7 622.6,1428.1 634.0,1430.3Z M343.7,1407.7 350.0,1404.7 350.3,1409.3 343.7,1407.7Z M871.7,1300.8 869.3,1318.0 849.2,1320.3 841.1,1335.7 823.4,1336.6 799.9,1362.0 793.7,1357.8 779.7,1361.6 769.9,1384.4 753.3,1383.7 695.9,1417.8 689.1,1412.5 678.6,1423.8 676.0,1417.0 679.8,1416.6 684.7,1413.8 685.4,1412.9 685.5,1412.0 677.7,1412.2 670.7,1401.8 662.4,1411.4 668.0,1414.3 657.7,1418.2 658.0,1409.4 653.9,1416.2 644.6,1397.2 639.1,1410.5 643.5,1406.9 648.9,1414.5 647.9,1428.0 613.5,1424.5 649.2,1440.2 647.8,1448.4 639.8,1452.6 640.2,1449.6 637.3,1445.1 638.0,1455.3 630.7,1459.1 605.6,1436.8 618.2,1455.2 640.2,1468.2 631.7,1476.3 619.4,1465.2 605.9,1456.4 591.0,1439.7 587.9,1438.6 627.5,1484.1 620.3,1503.3 608.7,1505.9 562.7,1459.5 553.7,1457.5 588.7,1501.8 591.4,1510.6 584.7,1519.4 589.9,1521.9 522.5,1548.5 498.1,1586.6 488.8,1582.2 484.6,1586.1 477.8,1583.2 471.1,1585.8 467.3,1588.2 467.2,1590.4 462.2,1593.0 454.0,1590.3 461.9,1587.2 462.5,1580.1 449.4,1581.6 456.5,1487.5 460.5,1475.0 477.2,1462.3 480.7,1468.4 481.1,1462.3 469.3,1446.4 458.7,1447.4 448.0,1434.3 430.5,1442.1 419.0,1418.0 422.5,1417.1 422.4,1413.0 414.6,1419.1 414.4,1413.0 420.5,1413.7 429.8,1401.3 458.4,1401.2 479.8,1382.3 473.7,1364.8 480.2,1357.4 504.8,1369.1 513.0,1356.4 547.7,1350.4 557.3,1368.4 563.2,1370.1 566.7,1364.0 590.2,1376.4 584.6,1361.1 591.4,1355.3 589.1,1347.3 557.1,1322.3 558.3,1300.8 871.7,1300.8Z M866.2,1400.0 863.9,1403.8 863.1,1399.8 866.2,1400.0Z" fill="#5B6675" stroke="#16243D" stroke-opacity="0.45" stroke-width="1.1" stroke-linejoin="round"/><path d="M553.4,309.3 L533.1,270.3 L573.7,270.3 Z" fill="#E3A23A"/><circle cx="553.4" cy="270.3" r="26.0" fill="#E3A23A"/><circle cx="553.4" cy="270.3" r="9.4" fill="#fff"/><text x="498.4" y="271.3" text-anchor="end" fill="#16243D" font-family="Poppins, sans-serif" font-size="34" font-weight="500">Hanoi</text><path d="M790.2,826.9 L769.9,787.9 L810.5,787.9 Z" fill="#16243D"/><circle cx="790.2" cy="787.9" r="26.0" fill="#16243D"/><circle cx="790.2" cy="787.9" r="9.4" fill="#fff"/><text x="845.2" y="788.9" text-anchor="start" fill="#16243D" font-family="Poppins, sans-serif" font-size="34" font-weight="500">Da Nang</text><path d="M633.0,1371.2 L612.7,1332.2 L653.3,1332.2 Z" fill="#E3A23A"/><circle cx="633.0" cy="1332.2" r="26.0" fill="#E3A23A"/><circle cx="633.0" cy="1332.2" r="9.4" fill="#fff"/><text x="688.0" y="1333.2" text-anchor="start" fill="#16243D" font-family="Poppins, sans-serif" font-size="34" font-weight="500">Ho Chi Minh City</text><text x="330.0" y="145.7" text-anchor="middle" fill="#16243D" fill-opacity="0.85" font-family="Poppins, sans-serif" font-size="36" font-weight="700" letter-spacing="5">NORTH</text><text x="1020.0" y="946.9" text-anchor="middle" fill="#16243D" fill-opacity="0.85" font-family="Poppins, sans-serif" font-size="36" font-weight="700" letter-spacing="5">CENTRAL</text><text x="940.0" y="1446.4" text-anchor="middle" fill="#16243D" fill-opacity="0.85" font-family="Poppins, sans-serif" font-size="36" font-weight="700" letter-spacing="5">SOUTH</text></svg>';

	$css = '<style>'
		. '.vds-regions{background:#fff}'
		. '.vds-regions .vds-map{max-width:100%;margin:0 auto;display:block}'
		. '.vds-regions .vds-map svg{width:100%;height:auto;border-radius:14px}'
		. '.vds-regions .vds-lede{font-size:17px;line-height:30px;margin-bottom:34px}'
		. '.vds-region{display:flex;gap:16px;padding:20px 0;border-top:1px solid rgba(22,36,61,.10)}'
		. '.vds-region:last-child{border-bottom:1px solid rgba(22,36,61,.10)}'
		. '.vds-region .swatch{flex:0 0 6px;border-radius:3px}'
		. '.vds-region h3{font-size:22px;line-height:26px;margin:0 0 4px}'
		. '.vds-region .place{font-size:14px;color:#16243D;opacity:.6;margin:0 0 6px}'
		. '.vds-region p.desc{margin:0;font-size:15px;line-height:25px}'
		. '.vds-regions .vds-outro{margin-top:32px;font-size:16px;line-height:28px}'
		. '.why-chose-us .chose-wrapper{display:flex;flex-direction:column}'
		. '.why-chose-us .chose-wrapper .section-title{order:1}'
		. '.why-chose-us .chose-wrapper p{order:2;margin-bottom:22px}'
		. '.why-chose-us .chose-wrapper p:empty{display:none;margin:0}'
		. '.why-chose-us .chose-wrapper .chose-box{display:none}'
		. '.why-chose-us .grey-bg-soft{background:#fff;padding-top:120px;padding-bottom:110px}'
		. '.why-chose-us .chose-wrapper{background:transparent;padding:0;margin-bottom:0}'
		. '.why-chose-us .section-title{padding-right:0}'
		. '.why-chose-us .section-title h2{line-height:44px;margin-bottom:25px}'
		. '.why-chose-us img.chose-shape{display:none !important}'
		. '.why-chose-us .chose-img-wrapper{height:auto}'
		. '.why-chose-us .chose-img-wrapper .big-img{max-width:100%;height:auto;display:block;border-radius:14px;margin-left:0}'
		. '@media(min-width:1200px){'
		.   '.why-chose-us .container>.row>div:first-child,'
		.   '.vds-regions .container>.row>div:first-child{flex:0 0 42%;max-width:42%}'
		.   '.why-chose-us .container>.row>div:last-child,'
		.   '.vds-regions .container>.row>div:last-child{flex:0 0 58%;max-width:58%}'
		. '}'
		. '.vds-team-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:44px 28px}'
		. '@media(max-width:991px){.vds-team-grid{grid-template-columns:repeat(2,1fr)}}'
		. '@media(max-width:575px){.vds-team-grid{grid-template-columns:1fr}}'
		. '.vds-member{background:transparent;border-radius:5px;overflow:hidden;box-shadow:none;transition:.5s}'
		. '.vds-member:hover{background:#fff;box-shadow:0 0 26px rgba(215,212,212,.35);transform:translateY(-25px)}'
		. '.vds-member .photo{aspect-ratio:1/1;background:#EAF0F6;display:flex;align-items:center;justify-content:center;position:relative}'
		. '.vds-member .photo img{width:100%;height:100%;object-fit:cover;display:block}'
		. '.vds-member .initial{font-family:Saira Extra Condensed,sans-serif;font-size:64px;font-weight:700;color:#16243D;opacity:.22;line-height:1}'
		. '.vds-member .todo{position:absolute;bottom:12px;left:0;right:0;text-align:center;font-size:11px;letter-spacing:1px;text-transform:uppercase;color:#16243D;opacity:.45}'
		. '.vds-member .body{padding:18px 20px 24px;text-align:center}'
		. '.vds-member h3{font-size:22px;line-height:26px;margin:0 0 2px}'
		. '.vds-member .role{font-size:14px;margin:0;color:#16243D;opacity:.7}'
		. '.vds-member .pill{display:inline-block;font-size:11px;letter-spacing:1px;text-transform:uppercase;padding:4px 10px;border-radius:20px;margin-bottom:12px;color:#16243D}'
		. '.vds-member p.bio{margin:0;font-size:14px;line-height:24px}'
		. '.vds-member p.bio.pending{opacity:.5;font-style:italic}'
		. '.pill-north{background:#D0D3D8}.pill-central{background:#969CA8}.pill-south{background:#5B6675;color:#fff}.pill-all{background:#E3A23A}'
		. '.sw-north{background:#D0D3D8}.sw-central{background:#969CA8}.sw-south{background:#5B6675}'
		. '.vds-eco{background:#fff}'
		. '.vds-eco-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:44px 28px}'
		. '@media(max-width:991px){.vds-eco-grid{grid-template-columns:repeat(3,1fr)}}'
		. '@media(max-width:575px){.vds-eco-grid{grid-template-columns:repeat(2,1fr)}}'
		. ''
		. '.vds-eco-item img{max-width:94%;width:auto;height:auto;object-fit:contain}'
		/* section order - replaces the old repositioning script */
		. 'main{display:flex;flex-direction:column}'
		. 'main>*{order:70}'
		. 'main>.page-title-area{order:10}'
		. 'main>.why-chose-us{order:20}'
		. 'main>.vds-regions{order:30}'
		. 'main>.vds-team{order:40}'
		. 'main>.logistics-services{order:50}'
		. 'main>.vds-eco{order:60}'
		. 'main>.copic-team{display:none}'
		. 'main>section.pt-120.pb-110:not([class*="vds-"]):not(.sky-blue-bg){display:none}'
		. '</style>';

	$out  = $css;

	$out .= '<section class="vds-regions pt-120 pb-110 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60">';
	$out .= '<div class="container"><div class="row align-items-center">';
	$out .= '<div class="col-xl-4 col-lg-6 mb-40"><div class="vds-map">' . $svg . '</div></div>';
	$out .= '<div class="col-xl-8 col-lg-6">';
	$out .= '<h2 class="mb-25">Where We Source: North, Central, and South</h2>';
	$out .= '<p class="vds-lede">Our specialists are based in Hanoi, Da Nang and Ho Chi Minh City. That means factory visits at short notice, quality checks carried out in person, and negotiation in Vietnamese &mdash; not a broker relaying messages from another country.</p>';
	foreach ( $regions as $r ) {
		$out .= '<div class="vds-region">'
			. '<div class="swatch sw-' . $r[3] . '"></div>'
			. '<div><h3>' . $r[0] . '</h3>'
			. '<p class="place">' . $r[1] . '</p>'
			. '<p class="desc">' . $r[2] . '</p></div></div>';
	}
	$out .= '</div></div></div></section>';

	$out .= '<section class="vds-team sky-blue-bg round-background pt-120 pb-110 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60">';
	$out .= '<div class="container">';
	$out .= '<div class="row justify-content-center"><div class="col-xl-8">'
		. '<div class="section-title text-center mb-70">'
		. '<h2 class="mb-20">The Local Experts Managing Your Supply Chain</h2>'
		. '<p>Sourcing specialists in each region, supported by logistics and technology. Every one of them is a direct employee &mdash; there is no agent layer between you and the factory.</p>'
		. '</div></div></div>';
	$out .= '<div class="vds-team-grid">';
	foreach ( $team as $m ) {
		list( $name, $role, $key, $label, $photo ) = $m;
		$out .= '<div class="vds-member"><div class="photo">';
		if ( $photo ) {
			$out .= '<img src="' . esc_url( $upload . $photo ) . '" alt="' . esc_attr( $name )
				. ', ' . esc_attr( $role ) . ' at Vietnam Direct Sourcing" loading="lazy" />';
		} else {
			$out .= '<span class="initial">' . esc_html( mb_substr( $name, 0, 1 ) ) . '</span>'
				. '<span class="todo">photo to add</span>';
		}
		$out .= '</div><div class="body">'
			. '<span class="pill pill-' . $key . '">' . esc_html( $label ) . '</span>'
			. '<h3>' . esc_html( $name ) . '</h3>'
			. '<p class="role">' . esc_html( $role ) . '</p>';
		if ( isset( $linkedin[ $name ] ) ) {
			$out .= '<a href="' . esc_url( $linkedin[ $name ] ) . '" target="_blank" rel="noopener" aria-label="' . esc_attr( $name ) . ' on LinkedIn" style="display:inline-block;margin-top:8px;color:#0A66C2;line-height:0"><svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.03-3.04-1.85-3.04-1.85 0-2.14 1.45-2.14 2.94v5.67H9.35V9h3.41v1.56h.05c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.45v6.29zM5.34 7.43a2.06 2.06 0 1 1 0-4.12 2.06 2.06 0 0 1 0 4.12zM7.12 20.45H3.56V9h3.56v11.45z"/></svg></a>';
		}
		$out .= '</div></div>';
	}
	$out .= '</div></div></section>';

	// ------------------------------------------------------------- ecosystem
	$out .= '<section class="vds-eco pt-120 pb-110 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60">';
	$out .= '<div class="container">';
	$out .= '<div class="row justify-content-center"><div class="col-xl-8">'
		. '<div class="section-title text-center mb-70">'
		. '<h2 class="mb-20">Tech-Enabled Transparency</h2>'
		. '<p>We run an integrated tech stack — including Odoo ERP — to give you real-time visibility into supplier vetting, factory audits, quality inspections, and shipment status. You see where your production actually stands, not just what we report back.</p>'
		. '</div></div></div>';
	$out .= '<div class="vds-eco-grid">';
	foreach ( $logos as $l ) {
		$out .= '<div class="vds-member"><div class="photo"><img src="' . esc_url( $upload . $l[0] ) . '" alt="' . esc_attr( $l[1] ) . '" loading="lazy" /></div><div class="body"><h3>' . esc_html( $l[1] ) . '</h3></div></div>';
	}
	$out .= '</div></div></section>';


	echo $out;
}, 5 );
