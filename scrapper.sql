-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2020 at 05:39 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scrapper`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_03_16_071124_create_news_table', 2),
(4, '2020_03_16_081249_create_newspapers_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `headline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spechial_news` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `news_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `news_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pdf_file` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collected_by` int(11) DEFAULT NULL,
  `news_date` date DEFAULT NULL,
  `newspaper_id` int(11) DEFAULT NULL,
  `newspaper_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `headline`, `spechial_news`, `news_description`, `image_link`, `news_url`, `pdf_file`, `collected_by`, `news_date`, `newspaper_id`, `newspaper_name`, `created_at`, `updated_at`) VALUES
(1, '<h1>Patient with coronavirus-like symptoms flees from hospital</h1>', '', 'A patient with coronavirus-like symptoms escaped from Dhaka\'s Shaheed Suhrawardy Medical College and Hospital this afternoon.Shahjahan (40), who returned from Bahrain, was admitted to the hospital\'s medicine ward around 8:00am today.He has been suffering from fever, cough, sneezing and breathing difficulties, the hospital\'s Director Uttam Kumar Barua told The Daily Star.After examining his health condition, doctors suspected that it might be a case of coronavirus, so they called for a team from Institute of Epidemiology, Disease Control and Research (IEDCR), the director said.When the IEDCR team reached the hospital around 12:30pm and went to the medicine ward, doctors did not find him and his wife, he added.Uma Rani Saha, a nurse at the hospital, told The Daily Star that the patient was very nervous when he heard that he might be infected with coronavirus.Shahjahan, hailing from Noakhali, came to Dhaka from Bahrain on January 18.', '<img src=\"https://assetsds.cdnedge.bluemix.net/sites/default/files/styles/big_2/public/feature/images/suhrawardy_hospital_1.jpg?itok=S_T4doUw&c=ff236fbb118ab6519d10d23dfbd9260d\" />', 'https://www.thedailystar.net/city/patient-coronavirus-symptoms-flees-hospital-1881205', '1584525364.pdf', 1, '2020-03-18', 1, 'The Daily Star', '2020-03-18 03:56:04', '2020-03-18 03:56:04'),
(2, '<h1>Bangladesh reports first coronavirus death</h1>', '', 'A Bangladeshi -- who tested positive for coronavirus infection -- has died, Prof Meerjady Sabrina Flora, director of Institute of Epidemiology, Disease Control and Research (IEDCR) said today.The patient was over 70 years old, she said while talking to journalists during a press briefing at IEDCR.The patient had multiple pre-existing complications like chronic obstructive pulmonary disease (COPD), high blood pressure, heart problems and diabetes, the director said, adding that he had heart stenting done previously.The current number of coronavirus affected people in the country in 14, the director said. A total of 16 people have been kept in isolation while 42 are kept in institutionalised quarantine, she added.IEDCR has tested samples from 49 people in the last 24 hours. So far the institution has tested 341 samples.', '<img src=\"https://assetsds.cdnedge.bluemix.net/sites/default/files/styles/big_2/public/feature/images/breaking-news-logo-old_3.jpg?itok=tCORt0nf\" />', 'https://www.thedailystar.net/coronavirus-deadly-new-threat/news/1-dead-coronavirus-infection-1882474', '1584530658.pdf', 1, '2020-03-18', 1, 'The Daily Star', '2020-03-18 05:24:18', '2020-03-18 05:24:18'),
(3, '<h1>4 DMCH doctors in home quarantine</h1>', '', 'Four doctors of Dhaka Medical College Hospital (DMCH) were sent to home quarantine yesterday, since all four handled an identified coronavirus patient without any protective gear for over a week.  However, the nurses or ward helpers who actually touched the patient or administered intravenous medication, were not sent on quarantine.   Furthermore, no step was taken to quarantine the other patients of the ward where the coronavirus patient was admitted. \"The patient who tested positive for coronavirus was admitted to the medicine ward around 8 or 9 days back, with flu-like symptoms,\" described Professor Dr Mujibur Rahman, the head of the Department of Medicine at DMCH. The patient was a returnee from a foreign country, but Dr Rahman requested that the country not be named to maintain the patient\'s privacy.\"The patient was treated for his symptomes and given dialysis. On Tuesday we found out that his symptoms suggested that he has the coronavirus. So we called the Institute of Epidemiology Disease Control And Research (IEDCR) and they came to collect his samples,\" described Professor Mujibur Rahman. The patient\'s results came back positive yesterday. A board immediately sat down to discuss the next steps, and the four doctors who the dealt most with the patient were sent on home-quarantine. A professor of medicine at Dhaka Medical College Hospital said, \"We are constantly getting patients with flu-like symptoms. We continue to work in these conditions without any protection.\" ', '<img src=\"https://assetsds.cdnedge.bluemix.net/sites/default/files/styles/very_big_1/public/feature/images/dmch_1_0.jpg?itok=4nGgOEwz\" />', 'https://www.thedailystar.net/online/news/4-dmch-doctors-home-quarantine-1882477', '1584530735.pdf', 1, '2020-03-18', 1, 'The Daily Star', '2020-03-18 05:25:35', '2020-03-18 05:25:35'),
(4, '<h2>Coronavirus symptoms? WHO says avoid self-medicating</h2>', '', 'The World Health Organisation on Tuesday recommended that people suffering from COVID-19-like symptoms should avoid self-medicating with ibuprofen, after French authorities warned anti-inflammatory drugs could worsen the effects of the virus.The warnings over the weekend by French Health Minister Olivier Veran followed a recent study in The Lancet weekly medical journal that hypothesised that an enzyme that is boosted when taking anti-inflammatory drugs like ibuprofen could facilitate and worsen COVID-19 infections.He stressed though that if ibuprofen had been “prescribed by the healthcare professionals, then, of course, that’s up to them”.His comments came after Veran sent a tweet cautioning that the use of ibuprofen and similar anti-inflammatory drugs could be “an aggravating factor” in COVID-19 infections.“In the case of fever, take paracetamol,” he wrote.He stressed that patients already being treated with anti-inflammatory drugs, should “ask advice from your doctor.” Paracetamol must be taken strictly according to the dose, because too high a dosage can be very dangerous for the liver.The COVID-19 pandemic, which has infected more than 180,000 people worldwide and killed more than 7,000, causes mild symptoms in most people, but can result in pneumonia and in some cases severe illness that can lead to multiple organ failure. ', '<img src=\"./assets/importent_images/printer_icon.png\" /><img src=\"https://www.daily-sun.com/assets/news_images/2020/03/18/Medicine.PNG\" /><img src=\"./assets/images/banner/20200305041625.jpg\" /><img src=\"./assets/images/banner/20200303083406.png\" />', 'https://www.daily-sun.com/post/470089/Coronavirus-symptoms-WHO-says-avoid-selfmedicating', '1584530830.pdf', 1, '2020-03-18', 2, 'The Daily Sun', '2020-03-18 05:27:10', '2020-03-18 05:27:10'),
(5, '<h2>Coronavirus symptoms? WHO says avoid self-medicating</h2>', '', 'The World Health Organisation on Tuesday recommended that people suffering from COVID-19-like symptoms should avoid self-medicating with ibuprofen, after French authorities warned anti-inflammatory drugs could worsen the effects of the virus.The warnings over the weekend by French Health Minister Olivier Veran followed a recent study in The Lancet weekly medical journal that hypothesised that an enzyme that is boosted when taking anti-inflammatory drugs like ibuprofen could facilitate and worsen COVID-19 infections.He stressed though that if ibuprofen had been “prescribed by the healthcare professionals, then, of course, that’s up to them”.His comments came after Veran sent a tweet cautioning that the use of ibuprofen and similar anti-inflammatory drugs could be “an aggravating factor” in COVID-19 infections.“In the case of fever, take paracetamol,” he wrote.He stressed that patients already being treated with anti-inflammatory drugs, should “ask advice from your doctor.” Paracetamol must be taken strictly according to the dose, because too high a dosage can be very dangerous for the liver.The COVID-19 pandemic, which has infected more than 180,000 people worldwide and killed more than 7,000, causes mild symptoms in most people, but can result in pneumonia and in some cases severe illness that can lead to multiple organ failure. ', '<img src=\"./assets/importent_images/printer_icon.png\" /><img src=\"https://www.daily-sun.com/assets/news_images/2020/03/18/Medicine.PNG\" /><img src=\"./assets/images/banner/20200305041625.jpg\" /><img src=\"./assets/images/banner/20200303083406.png\" />', 'https://www.daily-sun.com/post/470089/Coronavirus-symptoms-WHO-says-avoid-selfmedicating', '1584530901.pdf', 1, '2020-03-18', 2, 'The Daily Sun', '2020-03-18 05:28:21', '2020-03-18 05:28:21');

-- --------------------------------------------------------

--
-- Table structure for table `newspapers`
--

CREATE TABLE `newspapers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dom_element` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `image_base_url` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newspapers`
--

INSERT INTO `newspapers` (`id`, `name`, `url`, `dom_element`, `logo`, `status`, `image_base_url`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'The Daily Star', 'https://www.thedailystar.net/', 'h1,.storyContent h5,.view-mode-full p,.featured-image img', '2020-03/15843496914.jpg', 1, NULL, 1, 1, '2020-03-16 03:08:11', '2020-03-17 23:37:56'),
(2, 'The Daily Sun', 'https://www.daily-sun.com', '.news-headline, .details img, article p', '2020-03/1584355189logo.png', 1, NULL, 1, NULL, '2020-03-16 04:39:50', '2020-03-17 23:41:41'),
(3, 'New Age Bangladesh', 'https://www.newagebd.net', '.postInnerTopIn h3, .postPageTestIn img, .postPageTestIn p', '2020-03/15843554821_2.png', 1, NULL, 1, 1, '2020-03-16 04:44:42', '2020-03-17 23:15:15'),
(4, 'bdnews24', 'https://bdnews24.com/', 'h1,.media img,h5.print-only, .custombody p', '2020-03/1584357030logo1.png', 1, NULL, 1, NULL, '2020-03-16 05:10:31', '2020-03-17 23:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_change_req` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `profile_image`, `group_id`, `password`, `status`, `password_change_req`, `request_at`, `remember_token`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Super', 'Admin', 'admin@gmail.com', '2019-05/1558846540ariq.png', '1', '$2y$10$FliFAxmD6SrnITCAHF3I/uatKcxR8sOE/9/QDJdXaH8uVEByGkS8e', '1', NULL, NULL, NULL, NULL, 1, '2018-09-30 07:01:37', '2019-11-20 03:17:05'),
(2, 'Md Abdullah', 'Al Mamun', 'mamun.pustice@gmail.com', '2018-10/1538469823freenancer.jpg', '2', '$2y$10$PYyTqjvJpwcZOtcVhKYmZehgOkmlFGW7anw.UZVgPgm0KwSQznVwm', '1', NULL, NULL, NULL, NULL, NULL, '2018-10-02 02:43:43', '2018-11-25 01:58:12'),
(3, 'md', 'wasim', 'md.wasim0@gmail.com', '2018-10/1538655195productdetail-156.png', '1', '$2y$10$7Rb825TlNPGufIrw3c7Jf.aEhYLS./d2JS3SEKknsMLDrYjEpvILK', '1', NULL, NULL, NULL, NULL, NULL, '2018-10-04 06:13:16', '2019-05-08 00:30:13'),
(4, 'mr', 'x', 'admin@demo.com', NULL, '2', '$2y$10$fmB5lRHLO6y8ze231gMBmu0PcmYEp7qGXTC4plItiOHcOGuI.GGFC', '1', NULL, NULL, NULL, 1, NULL, '2019-02-02 23:59:03', '2019-02-02 23:59:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newspapers`
--
ALTER TABLE `newspapers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `newspapers`
--
ALTER TABLE `newspapers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
