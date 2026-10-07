<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenKaryawanSeeder extends Seeder
{
    public function run(): void
    {
        $dosen = [
            ['no' => 1, 'inisial' => 'AGY', 'nama_dosen' => 'dr. Anggi Gilang Yudiansyah, MMRS', 'npp' => '200804198732109', 'nidn' => '0708048705', 'unit_kerja' => 'Adm. RS', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 2, 'inisial' => 'ARM', 'nama_dosen' => 'dr. H. Abdul Rokhim, MARS., FISQua', 'npp' => '232007196732101', 'nidn' => '0720076704', 'unit_kerja' => 'Adm. RS', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 3, 'inisial' => 'LUT', 'nama_dosen' => 'dr. Lutfi Rachman, MMRS', 'npp' => '171402197432191', 'nidn' => '0714027404', 'unit_kerja' => 'Adm. RS', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 4, 'inisial' => 'MAS', 'nama_dosen' => 'dr. Muhammad Arif Surjadi, MMRS', 'npp' => '241312197032134', 'nidn' => '0713127002', 'unit_kerja' => 'Adm. RS', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 5, 'inisial' => 'NLA', 'nama_dosen' => 'dr. Nur Laily Agustina, MMRS', 'npp' => '1712.01.01.1.001', 'nidn' => null, 'unit_kerja' => 'Adm. RS', 'status_kepegawaian' => 'Kontrak Fakultas'],
            ['no' => 6, 'inisial' => 'SHL', 'nama_dosen' => 'Sri Herlina, SKM, MPH', 'npp' => '163107198332215', 'nidn' => '0731078306', 'unit_kerja' => 'Adm. RS', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 7, 'inisial' => 'TWS', 'nama_dosen' => 'dr. H. Tri Wahyu Sarwiyata, M. Kes', 'npp' => '170811196632195', 'nidn' => '0708116601', 'unit_kerja' => 'Adm. RS', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 8, 'inisial' => 'ACH', 'nama_dosen' => 'Achdan Sukmana S. Farm', 'npp' => '2301.04.01.0.001', 'nidn' => null, 'unit_kerja' => 'Farmasi', 'status_kepegawaian' => 'Kontrak Fakultas'],
            ['no' => 9, 'inisial' => 'AQZ', 'nama_dosen' => 'apt. Andri Tilaqza, M.Farm', 'npp' => '170104198632192', 'nidn' => '0707048601', 'unit_kerja' => 'Farmasi', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 10, 'inisial' => 'ARA', 'nama_dosen' => 'apt. Arina Swastika Maulita, M.Farm', 'npp' => '1910.04.01.2.001', 'nidn' => null, 'unit_kerja' => 'Farmasi', 'status_kepegawaian' => 'Kontrak Fakultas'],
            ['no' => 11, 'inisial' => 'DMM', 'nama_dosen' => 'Denis Mery Mirza, M.Farm', 'npp' => '221606199432117', 'nidn' => '0716069402', 'unit_kerja' => 'Farmasi', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 12, 'inisial' => 'DNR', 'nama_dosen' => 'apt. Rizky Daniar Iftitach Febriana, S.Farm', 'npp' => '2406.04.01.2.001', 'nidn' => null, 'unit_kerja' => 'Farmasi', 'status_kepegawaian' => 'Kontrak Fakultas'],
            ['no' => 13, 'inisial' => 'DNV', 'nama_dosen' => 'Dian Novita Wulandari, S.Farm., M.Imun', 'npp' => '191711199132237', 'nidn' => '0717119101', 'unit_kerja' => 'Farmasi', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 14, 'inisial' => 'IKE', 'nama_dosen' => 'Ike Widyaningrum, M.Farm', 'npp' => '180407199032201', 'nidn' => '0704079002', 'unit_kerja' => 'Farmasi', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 15, 'inisial' => 'NIT', 'nama_dosen' => 'Dr. apt. Anita Puspa Widiyana, M.Farm', 'npp' => '180510198732204', 'nidn' => '0705108702', 'unit_kerja' => 'Farmasi', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 16, 'inisial' => 'NUG', 'nama_dosen' => 'apt. Nugroho Wibisono, S.Farm, M.Si', 'npp' => '181802199232102', 'nidn' => '0718029201', 'unit_kerja' => 'Farmasi', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 17, 'inisial' => 'YDA', 'nama_dosen' => 'Dr. apt. Yudi Purnomo, M.Kes', 'npp' => '205.02.00005', 'nidn' => '0730047301', 'unit_kerja' => 'Farmasi', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 18, 'inisial' => 'RYN', 'nama_dosen' => 'Apt. Ryan Afandi, M.Farm', 'npp' => '2508.01.02.2.003', 'nidn' => null, 'unit_kerja' => 'Farmasi', 'status_kepegawaian' => 'Kontrak Fakultas'],
            ['no' => 19, 'inisial' => 'HAD', 'nama_dosen' => 'Apt. Heny Dwi Arini, M.Farm', 'npp' => '2508.01.02.2.001', 'nidn' => null, 'unit_kerja' => 'Farmasi', 'status_kepegawaian' => 'Kontrak Fakultas'],
            ['no' => 20, 'inisial' => 'ZAQ', 'nama_dosen' => 'Apt. Zaenab Aqilah, S.Farm', 'npp' => '2506.01.01.2.001', 'nidn' => null, 'unit_kerja' => 'Farmasi', 'status_kepegawaian' => 'Kontrak Fakultas'],
            ['no' => 21, 'inisial' => 'AHW', 'nama_dosen' => 'dr. Arief Heru Wicaksono, Sp.An', 'npp' => '210.02.00014', 'nidn' => '0728127805', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 22, 'inisial' => 'AMD', 'nama_dosen' => 'Amelia, M.Psi, Psikolog', 'npp' => '131412197032220', 'nidn' => '0714017106', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 23, 'inisial' => 'ARS', 'nama_dosen' => 'dr. Aris Rosidah, M.Biomed., Sp.PA', 'npp' => '142104198232240', 'nidn' => '0721048204', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 24, 'inisial' => 'BBP', 'nama_dosen' => 'Beta Bela Pratiwi, S.Psi., M.Psi., Psikolog', 'npp' => '241203199332235', 'nidn' => '0712039305', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 25, 'inisial' => 'CTR', 'nama_dosen' => 'dr. Citra Destya Rahma Putri, Sp.MK', 'npp' => '241612199132233', 'nidn' => '0716129102', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 26, 'inisial' => 'DAY', 'nama_dosen' => "dr. Dhau 'Atha Yudhisthira, M. Kes", 'npp' => '2309.01.01.1.002', 'nidn' => null, 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Kontrak Fakultas'],
            ['no' => 27, 'inisial' => 'DKT', 'nama_dosen' => 'Dr. dr. H. Dicky Kurniawan Tontowiputro, Sp.PD, FINASIM, SH', 'npp' => '1914121977321900', 'nidn' => '8906610021', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Luar Biasa'],
            ['no' => 28, 'inisial' => 'DMI', 'nama_dosen' => 'dr. Dewi Martha Indria, M.Kes, IBCLC', 'npp' => '142005198632237', 'nidn' => '0720058604', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 29, 'inisial' => 'DSD', 'nama_dosen' => 'Dr. dr. Dini Sri Damayanti, M.Kes', 'npp' => '205.02.00006', 'nidn' => '0708106801', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 30, 'inisial' => 'DTI', 'nama_dosen' => 'Dr. dr. Doti Wahyuningsih, M.Kes', 'npp' => '2122031956322900', 'nidn' => '8926140022', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Luar Biasa'],
            ['no' => 31, 'inisial' => 'ESW', 'nama_dosen' => 'dr. Erna Sulistyowati, M.Kes., Ph.D', 'npp' => '205.02.00004', 'nidn' => '0713087501', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 32, 'inisial' => 'FBA', 'nama_dosen' => 'dr. Fancy Brahma Adiputra, M.Gz., AIFO-K', 'npp' => '202909197632108', 'nidn' => '0729097602', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 33, 'inisial' => 'FIN', 'nama_dosen' => 'dr. Fifin Pradina Duhitatrissari, Sp.T.H.T.K.L', 'npp' => '202901198132205', 'nidn' => '0729018102', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 34, 'inisial' => 'FNA', 'nama_dosen' => 'dr. Fitria Nugraha Aini, M. Biomed', 'npp' => '201306198832210', 'nidn' => '0713068804', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 35, 'inisial' => 'MIF', 'nama_dosen' => 'Dr. dr. H. Marindra Firmansyah, M.Med.Ed', 'npp' => '210.02.00024', 'nidn' => '0707098104', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 36, 'inisial' => 'MRA', 'nama_dosen' => 'dr. Merlita Herbani, M.Biomed', 'npp' => '151403198832243', 'nidn' => '0714038803', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 37, 'inisial' => 'MTS', 'nama_dosen' => 'dr. Nikmatus Sholihah, Sp.PK', 'npp' => '1803.01.01.1.001', 'nidn' => null, 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Kontrak Fakultas'],
            ['no' => 38, 'inisial' => 'NEA', 'nama_dosen' => 'dr. Hj. Noer Aini, M.Kes', 'npp' => '205.02.00007', 'nidn' => '0719126701', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 39, 'inisial' => 'PUT', 'nama_dosen' => 'dr. Putra Agung Dewata, Sp.EM', 'npp' => '2117071984321900', 'nidn' => '8974340022', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Luar Biasa'],
            ['no' => 40, 'inisial' => 'REZ', 'nama_dosen' => 'dr. Reza Hakim, M.Biomed', 'npp' => '112709198432122', 'nidn' => '0727098401', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 41, 'inisial' => 'RHM', 'nama_dosen' => 'dr. Rahma Triliana, M.Kes., Ph.D', 'npp' => '205.02.00001', 'nidn' => '0728077801', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 42, 'inisial' => 'RIM', 'nama_dosen' => 'dr. Rima Zakiyah, Sp.Rad', 'npp' => '151207198132242', 'nidn' => '0712078103', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 43, 'inisial' => 'RIO', 'nama_dosen' => 'Rio Risandiansyah, S.Ked., MP., PhD', 'npp' => '210.02.00026', 'nidn' => '0715068206', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 44, 'inisial' => 'RNA', 'nama_dosen' => "dr. Rosyidatun Nisa'', M.P.H (Adv)", 'npp' => '2405.01.02.1.002', 'nidn' => null, 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Kontrak Fakultas'],
            ['no' => 45, 'inisial' => 'ROS', 'nama_dosen' => 'dr. Rosaria Dian Lestari, M.Biomed', 'npp' => '140602198532239', 'nidn' => '0706028503', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 46, 'inisial' => 'RSS', 'nama_dosen' => 'dr. Rangga Pragasta SS, Sp.And', 'npp' => '240608198732132', 'nidn' => '0706088702', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 47, 'inisial' => 'RZA', 'nama_dosen' => 'dr. Hj. Rizki Anisa, M.Med.Ed', 'npp' => '210.02.00025', 'nidn' => '0707117901', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 48, 'inisial' => 'SAF', 'nama_dosen' => 'dr. Silvy Amalia Falyani, M.Biomed, Sp.P', 'npp' => '193107199032278', 'nidn' => '0731079002', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 49, 'inisial' => 'YAM', 'nama_dosen' => 'Yoyon Arif Martino, S.Si., M.Kes', 'npp' => '205.02.00002', 'nidn' => '0718117601', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 50, 'inisial' => 'YHA', 'nama_dosen' => 'dr. H. Arif Yahya, M.Kes', 'npp' => '205.02.00003', 'nidn' => '0704046304', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 51, 'inisial' => 'YNI', 'nama_dosen' => 'dr. Yeni Amalia, Sp.A., M.Biomed', 'npp' => '152501198232228', 'nidn' => '0725018206', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 52, 'inisial' => 'YRB', 'nama_dosen' => 'Yoni Rina Bintari, S.Si., M.Sc', 'npp' => '151406198932230', 'nidn' => '0714068902', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 53, 'inisial' => 'ZFL', 'nama_dosen' => 'drh. Muhammad Zainul Fadli, M.Kes', 'npp' => '188.02.00015', 'nidn' => '0714106101', 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 54, 'inisial' => 'AKI', 'nama_dosen' => 'dr. M. Dzulfikar Zaki, Sp.An-TI., M. Ked.Klin', 'npp' => '2508.01.02.1.004', 'nidn' => null, 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Kontrak Fakultas'],
            ['no' => 55, 'inisial' => 'ABD', 'nama_dosen' => 'dr. Abdurachman Omar Baabdullah, Sp.PD', 'npp' => '2508.01.02.1.005', 'nidn' => null, 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Kontrak Fakultas'],
            ['no' => 56, 'inisial' => 'KAS', 'nama_dosen' => 'dr. Khonsaa Aadilah Hafizhoh Subagyo, M.Biomed', 'npp' => '2508.01.02.1.002', 'nidn' => null, 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Kontrak Fakultas'],
            ['no' => 57, 'inisial' => 'WAK', 'nama_dosen' => 'dr. Wahyudi Kuncoro, M.MRS', 'npp' => '2508.01.02.1.006', 'nidn' => null, 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Kontrak Fakultas'],
            ['no' => 58, 'inisial' => 'SEO', 'nama_dosen' => 'dr. Millah Shofiyah, M.Biomed', 'npp' => '2501.01.02.1.001', 'nidn' => null, 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Kontrak Fakultas'],
            ['no' => 59, 'inisial' => 'TAZ', 'nama_dosen' => 'dr. Tazkia Azmi Salima', 'npp' => '2409.01.01.1.003', 'nidn' => null, 'unit_kerja' => 'Pend. Dokter', 'status_kepegawaian' => 'Kontrak Fakultas'],
            ['no' => 60, 'inisial' => 'ANS', 'nama_dosen' => 'dr. Fathia Annis Pramesti, Sp.N., M.Biomed', 'npp' => '210.02.00015', 'nidn' => '0724038001', 'unit_kerja' => 'Profesi Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 61, 'inisial' => 'ARN', 'nama_dosen' => 'dr. Ariani Ratri Dewi, Sp.M', 'npp' => '210.02.00017', 'nidn' => '0715027803', 'unit_kerja' => 'Profesi Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 62, 'inisial' => 'DEW', 'nama_dosen' => 'dr. Dhanti Erma Widiasi, Sp.Rad', 'npp' => '210.02.00019', 'nidn' => '0707118001', 'unit_kerja' => 'Profesi Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 63, 'inisial' => 'DHA', 'nama_dosen' => 'dr. Diah Andriana, Sp.B., FINACS., FICS', 'npp' => '112209196832220', 'nidn' => '0722096802', 'unit_kerja' => 'Profesi Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 64, 'inisial' => 'FKH', 'nama_dosen' => 'dr. Hj. Fenti Kusumawardhani Hidayah, Sp.M', 'npp' => '151702198132229', 'nidn' => '0717028101', 'unit_kerja' => 'Profesi Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 65, 'inisial' => 'RHA', 'nama_dosen' => 'dr. H. R. Muh. Hardadi Airlangga, Sp.PD., MH., CMC, CCD', 'npp' => '208.02.00001', 'nidn' => '0707116401', 'unit_kerja' => 'Profesi Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 66, 'inisial' => 'SAS', 'nama_dosen' => 'dr. Sasi Purwanti, Sp.DVE., FINSDV', 'npp' => '210.02.00020', 'nidn' => '0730017704', 'unit_kerja' => 'Profesi Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 67, 'inisial' => 'SNT', 'nama_dosen' => 'dr. Shinta Kusumawati, Sp.N', 'npp' => '152010198132226', 'nidn' => '0720108103', 'unit_kerja' => 'Profesi Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 68, 'inisial' => 'SWJ', 'nama_dosen' => 'dr. Sigit Wahyu Jatmiko, SpBP-RE., MM., MH', 'npp' => '151906197432141', 'nidn' => '0719067405', 'unit_kerja' => 'Profesi Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
            ['no' => 69, 'inisial' => 'ZIA', 'nama_dosen' => 'dr. Sri Fauziyah, M.Biomed., Sp.A', 'npp' => '110902198532221', 'nidn' => '0709028502', 'unit_kerja' => 'Profesi Dokter', 'status_kepegawaian' => 'Dosen Tetap'],
        ];

        $karyawan = [
            ['no' => 1, 'nama' => 'Ahmad Rosyad Al Muttaqin', 'npp' => '11260919851112', 'status_kepegawaian' => 'Karyawan tetap'],
            ['no' => 2, 'nama' => 'Andhika Putra Setiawan', 'npp' => '151408198831117', 'status_kepegawaian' => 'Karyawan tetap'],
            ['no' => 3, 'nama' => 'Anik Yuliani', 'npp' => '151007098431213', 'status_kepegawaian' => 'Karyawan tetap'],
            ['no' => 4, 'nama' => 'Arif Junaidi', 'npp' => '112106197931109', 'status_kepegawaian' => 'Karyawan tetap'],
            ['no' => 5, 'nama' => 'Arniyati, S.Si', 'npp' => '110903198631207', 'status_kepegawaian' => 'Karyawan tetap'],
            ['no' => 6, 'nama' => 'Atiek Indah Rahmawati, S.Pd', 'npp' => '110704198531204', 'status_kepegawaian' => 'Karyawan tetap'],
            ['no' => 7, 'nama' => 'Della Olivia Wijayanti, S.Pd', 'npp' => '151709198831212', 'status_kepegawaian' => 'Karyawan tetap'],
            ['no' => 8, 'nama' => 'Devina Titta Lestari, SH', 'npp' => '111410197631216', 'status_kepegawaian' => 'Karyawan tetap'],
            ['no' => 9, 'nama' => 'Erlin Novitasari, Amd', 'npp' => '112901198731211', 'status_kepegawaian' => 'Karyawan tetap'],
            ['no' => 10, 'nama' => "Fahma As'shar, S.Ak", 'npp' => '242409199731223', 'status_kepegawaian' => 'Karyawan tetap'],
            ['no' => 11, 'nama' => 'Ika Nurmawati, SE,Ak.', 'npp' => '112909197531205', 'status_kepegawaian' => 'Karyawan tetap'],
            ['no' => 12, 'nama' => 'Iva Yuliana Pratama, S,Ak.', 'npp' => '242111199631224', 'status_kepegawaian' => 'Karyawan tetap'],
            ['no' => 13, 'nama' => 'Merry Herliana, S.Pd', 'npp' => '111703198231201', 'status_kepegawaian' => 'Karyawan tetap'],
            ['no' => 14, 'nama' => 'Nanang Hadi Santoso', 'npp' => '172807198031132', 'status_kepegawaian' => 'Karyawan tetap'],
            ['no' => 15, 'nama' => 'Nofie Irmalia Nurita, S.Si', 'npp' => '110102198631208', 'status_kepegawaian' => 'Karyawan tetap'],
            ['no' => 16, 'nama' => 'Nurkhanila Agustin, Amd.Kep', 'npp' => '150408198532203', 'status_kepegawaian' => 'Karyawan tetap'],
            ['no' => 17, 'nama' => 'Ramadhini Fitria Rahardjo, S.Pd', 'npp' => '150408198031110', 'status_kepegawaian' => 'Karyawan tetap'],
            ['no' => 18, 'nama' => 'Rizki Ifan Prasetyo, SE., MM', 'npp' => '162010199031273', 'status_kepegawaian' => 'Karyawan tetap'],
            ['no' => 19, 'nama' => 'Subekti', 'npp' => '201.41.491980', 'status_kepegawaian' => 'Karyawan tetap'],
            ['no' => 20, 'nama' => 'Volvo Linandus Kaeng', 'npp' => '150210197531118', 'status_kepegawaian' => 'Karyawan tetap'],
            ['no' => 21, 'nama' => 'Zainur Ridho', 'npp' => '150101199431115', 'status_kepegawaian' => 'Karyawan tetap'],
            ['no' => 22, 'nama' => 'Aldy Bagaskara, S.IP', 'npp' => '2307.02.01.0.001', 'status_kepegawaian' => 'Kontrak'],
            ['no' => 23, 'nama' => "As'sad Durrohman, S.Kep Ners", 'npp' => '2009.01.01.0.001', 'status_kepegawaian' => 'Kontrak'],
            ['no' => 24, 'nama' => 'Edi Suwito', 'npp' => '2410.01.00.0.003', 'status_kepegawaian' => 'Kontrak'],
            ['no' => 25, 'nama' => 'Indra Cahya Setia Widigda, S.Pd', 'npp' => '1910.01.01.0.001', 'status_kepegawaian' => 'Kontrak'],
            ['no' => 26, 'nama' => 'Manda Maulana Musthofa, S.T', 'npp' => '2307.01.01.0.001', 'status_kepegawaian' => 'Kontrak'],
            ['no' => 27, 'nama' => 'Mohamad Thoif, S.Si', 'npp' => '2208.01.01.0.001', 'status_kepegawaian' => 'Kontrak'],
            ['no' => 28, 'nama' => 'Rukun Rahayu, S.Si', 'npp' => '2307.02.01.0.002', 'status_kepegawaian' => 'Kontrak'],
            ['no' => 29, 'nama' => 'Mochammad Mustakim, S.Si, Mos', 'npp' => '2501.01.01.0.002', 'status_kepegawaian' => 'Kontrak'],
            ['no' => 30, 'nama' => 'Aulia Putri Solikhatin S. Ak. M. M', 'npp' => '2501.01.01.0.003', 'status_kepegawaian' => 'Kontrak'],
        ];

        DB::table('dosen')->upsert(
            collect($dosen)->mapWithKeys(fn (array $record) => [
                $record['npp'] => $record,
            ])->all(),
            ['npp'],
        );

        DB::table('karyawan')->upsert(
            collect($karyawan)->mapWithKeys(fn (array $record) => [
                $record['npp'] => $record,
            ])->all(),
            ['npp'],
        );
    }
}
