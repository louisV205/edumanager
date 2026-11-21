-- ============================================================
--  EduManager — Complete MySQL 8.x SQL Script
--  Server  : 127.0.0.1:3306 (MySQL Workbench)
--  User    : root
--  Charset : utf8mb4 / utf8mb4_unicode_ci
--
--  Hướng dẫn chạy:
--    1. Mở MySQL Workbench → kết nối EduManager (localhost:3306)
--    2. File → Open SQL Script → chọn file này
--    3. Nhấn ⚡ Execute (Ctrl+Shift+Enter)
--
--  Tài khoản mặc định: Password@123
-- ============================================================

SET FOREIGN_KEY_CHECKS = 0;
SET NAMES utf8mb4;
SET time_zone = '+07:00';

-- ─────────────────────────────────────────────
-- DATABASE
-- ─────────────────────────────────────────────
DROP DATABASE IF EXISTS EduManager;
CREATE DATABASE EduManager
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
USE EduManager;

-- ============================================================
-- PHẦN 1: TẠO CẤU TRÚC BẢNG
-- ============================================================

-- ─────────────────────────────────────────────
-- 1. roles
-- ─────────────────────────────────────────────
CREATE TABLE roles (
    id           TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name         VARCHAR(50)      NOT NULL COMMENT 'admin | lecturer | student',
    display_name VARCHAR(100)     NOT NULL,
    created_at   DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at   DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_roles_name (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─────────────────────────────────────────────
-- 2. users
-- ─────────────────────────────────────────────
CREATE TABLE users (
    id         INT UNSIGNED     NOT NULL AUTO_INCREMENT,
    username   VARCHAR(50)      NOT NULL,
    email      VARCHAR(150)     NOT NULL,
    password   VARCHAR(255)     NOT NULL,
    role_id    TINYINT UNSIGNED NOT NULL,
    status     ENUM('active','locked','pending') NOT NULL DEFAULT 'active',
    avatar     VARCHAR(255)     DEFAULT NULL,
    created_at DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_users_username (username),
    UNIQUE KEY uq_users_email    (email),
    KEY fk_users_role (role_id),
    CONSTRAINT fk_users_role FOREIGN KEY (role_id) REFERENCES roles (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─────────────────────────────────────────────
-- 3. departments (Khoa)
-- ─────────────────────────────────────────────
CREATE TABLE departments (
    id        TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    code      VARCHAR(20)      NOT NULL COMMENT 'VD: CNTT, KTXD',
    name      VARCHAR(150)     NOT NULL,
    head_name VARCHAR(100)     DEFAULT NULL COMMENT 'Trưởng khoa',
    email     VARCHAR(100)     DEFAULT NULL,
    phone     VARCHAR(20)      DEFAULT NULL,
    status    ENUM('active','inactive') NOT NULL DEFAULT 'active',
    created_at DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_departments_code (code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─────────────────────────────────────────────
-- 4. majors (Ngành)
-- ─────────────────────────────────────────────
CREATE TABLE majors (
    id              SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    department_id   TINYINT UNSIGNED  NOT NULL,
    code            VARCHAR(20)       NOT NULL,
    name            VARCHAR(150)      NOT NULL,
    total_credits   SMALLINT UNSIGNED NOT NULL COMMENT 'Tổng tín chỉ toàn khóa',
    duration_years  TINYINT UNSIGNED  NOT NULL DEFAULT 4,
    status          ENUM('active','inactive') NOT NULL DEFAULT 'active',
    created_at      DATETIME          NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      DATETIME          NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_majors_code (code),
    KEY fk_majors_dept (department_id),
    CONSTRAINT fk_majors_dept FOREIGN KEY (department_id) REFERENCES departments (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─────────────────────────────────────────────
-- 5. lecturers (Hồ sơ giảng viên)
-- ─────────────────────────────────────────────
CREATE TABLE lecturers (
    id              INT UNSIGNED     NOT NULL AUTO_INCREMENT,
    user_id         INT UNSIGNED     NOT NULL,
    department_id   TINYINT UNSIGNED NOT NULL,
    lecturer_code   VARCHAR(20)      NOT NULL COMMENT 'VD: GV001',
    full_name       VARCHAR(100)     NOT NULL,
    gender          VARCHAR(10)      DEFAULT NULL,
    date_of_birth   DATE             DEFAULT NULL,
    phone           VARCHAR(20)      DEFAULT NULL,
    email_work      VARCHAR(100)     DEFAULT NULL,
    academic_rank   VARCHAR(50)      DEFAULT NULL COMMENT 'GS, PGS, TS, ThS',
    specialization  VARCHAR(150)     DEFAULT NULL,
    status          ENUM('active','on_leave','retired') NOT NULL DEFAULT 'active',
    created_at      DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_lecturers_user    (user_id),
    UNIQUE KEY uq_lecturers_code    (lecturer_code),
    KEY fk_lecturers_dept (department_id),
    CONSTRAINT fk_lecturers_user FOREIGN KEY (user_id)       REFERENCES users       (id),
    CONSTRAINT fk_lecturers_dept FOREIGN KEY (department_id) REFERENCES departments (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─────────────────────────────────────────────
-- 6. students (Hồ sơ sinh viên)
-- ─────────────────────────────────────────────
CREATE TABLE students (
    id              INT UNSIGNED     NOT NULL AUTO_INCREMENT,
    user_id         INT UNSIGNED     NOT NULL,
    major_id        SMALLINT UNSIGNED NOT NULL,
    student_code    VARCHAR(20)      NOT NULL COMMENT 'VD: 22A10001',
    full_name       VARCHAR(100)     NOT NULL,
    gender          VARCHAR(10)      DEFAULT NULL,
    date_of_birth   DATE             DEFAULT NULL,
    place_of_birth  VARCHAR(150)     DEFAULT NULL,
    id_card         VARCHAR(20)      DEFAULT NULL,
    phone           VARCHAR(20)      DEFAULT NULL,
    home_address    VARCHAR(255)     DEFAULT NULL,
    class_name      VARCHAR(50)      DEFAULT NULL COMMENT 'Lớp sinh hoạt',
    enrollment_year SMALLINT UNSIGNED NOT NULL COMMENT 'Năm nhập học, VD: 2022',
    course_year     SMALLINT UNSIGNED NOT NULL COMMENT 'Khóa học, VD: K67',
    training_type   ENUM('regular','transfer','part_time') NOT NULL DEFAULT 'regular',
    status          ENUM('studying','graduated','suspended','expelled') NOT NULL DEFAULT 'studying',
    tuition_total   BIGINT UNSIGNED  NOT NULL DEFAULT 0 COMMENT 'Học phí kỳ hiện tại',
    tuition_paid    BIGINT UNSIGNED  NOT NULL DEFAULT 0 COMMENT 'Đã đóng',
    created_at      DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_students_user    (user_id),
    UNIQUE KEY uq_students_code    (student_code),
    KEY fk_students_major (major_id),
    CONSTRAINT fk_students_user  FOREIGN KEY (user_id)  REFERENCES users   (id),
    CONSTRAINT fk_students_major FOREIGN KEY (major_id) REFERENCES majors  (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─────────────────────────────────────────────
-- 7. courses (Môn học)
-- ─────────────────────────────────────────────
CREATE TABLE courses (
    id              SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    department_id   TINYINT UNSIGNED  NOT NULL,
    course_code     VARCHAR(20)       NOT NULL COMMENT 'VD: WEB302',
    name            VARCHAR(150)      NOT NULL,
    credits         TINYINT UNSIGNED  NOT NULL,
    theory_hours    TINYINT UNSIGNED  NOT NULL DEFAULT 0,
    practice_hours  TINYINT UNSIGNED  NOT NULL DEFAULT 0,
    description     TEXT              DEFAULT NULL,
    status          ENUM('active','inactive') NOT NULL DEFAULT 'active',
    created_at      DATETIME          NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      DATETIME          NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_courses_code (course_code),
    KEY fk_courses_dept (department_id),
    CONSTRAINT fk_courses_dept FOREIGN KEY (department_id) REFERENCES departments (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─────────────────────────────────────────────
-- 8. course_prerequisites (Môn tiên quyết)
-- ─────────────────────────────────────────────
CREATE TABLE course_prerequisites (
    id              INT UNSIGNED      NOT NULL AUTO_INCREMENT,
    course_id       SMALLINT UNSIGNED NOT NULL COMMENT 'Môn chính',
    prerequisite_id SMALLINT UNSIGNED NOT NULL COMMENT 'Môn tiên quyết',
    type            ENUM('prerequisite','corequisite') NOT NULL DEFAULT 'prerequisite',
    created_at      DATETIME          NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      DATETIME          NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_prereq (course_id, prerequisite_id),
    KEY fk_prereq_prereq (prerequisite_id),
    CONSTRAINT fk_prereq_course  FOREIGN KEY (course_id)       REFERENCES courses (id),
    CONSTRAINT fk_prereq_prereq  FOREIGN KEY (prerequisite_id) REFERENCES courses (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─────────────────────────────────────────────
-- 9. semesters (Học kỳ)
-- ─────────────────────────────────────────────
CREATE TABLE semesters (
    id              TINYINT UNSIGNED  NOT NULL AUTO_INCREMENT,
    code            VARCHAR(20)       NOT NULL COMMENT 'VD: HK1-2026-2027',
    name            VARCHAR(100)      NOT NULL,
    academic_year   VARCHAR(20)       NOT NULL COMMENT 'VD: 2026-2027',
    semester_number TINYINT UNSIGNED  NOT NULL COMMENT '1=HK1, 2=HK2, 3=Hè',
    start_date      DATE              NOT NULL,
    end_date        DATE              NOT NULL,
    status          ENUM('upcoming','active','closed') NOT NULL DEFAULT 'upcoming',
    created_at      DATETIME          NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      DATETIME          NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_semesters_code (code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─────────────────────────────────────────────
-- 10. registration_periods (Đợt đăng ký tín chỉ)
-- ─────────────────────────────────────────────
CREATE TABLE registration_periods (
    id                  INT UNSIGNED     NOT NULL AUTO_INCREMENT,
    semester_id         TINYINT UNSIGNED NOT NULL,
    name                VARCHAR(100)     NOT NULL,
    registration_start  DATETIME         NOT NULL,
    registration_end    DATETIME         NOT NULL,
    min_credits         TINYINT UNSIGNED NOT NULL DEFAULT 10,
    max_credits         TINYINT UNSIGNED NOT NULL DEFAULT 24,
    status              ENUM('upcoming','open','closed','cancelled') NOT NULL DEFAULT 'upcoming',
    notes               TEXT             DEFAULT NULL,
    created_at          DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at          DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY fk_regperiod_sem (semester_id),
    CONSTRAINT fk_regperiod_sem FOREIGN KEY (semester_id) REFERENCES semesters (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─────────────────────────────────────────────
-- 11. rooms (Phòng học)
-- ─────────────────────────────────────────────
CREATE TABLE rooms (
    id        SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    room_code VARCHAR(20)       NOT NULL COMMENT 'VD: A203',
    building  VARCHAR(50)       DEFAULT NULL,
    capacity  SMALLINT UNSIGNED NOT NULL DEFAULT 40,
    type      ENUM('theory','lab','seminar') NOT NULL DEFAULT 'theory',
    status    ENUM('available','maintenance') NOT NULL DEFAULT 'available',
    created_at DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_rooms_code (room_code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─────────────────────────────────────────────
-- 12. course_sections (Lớp học phần)
-- ─────────────────────────────────────────────
CREATE TABLE course_sections (
    id               INT UNSIGNED      NOT NULL AUTO_INCREMENT,
    course_id        SMALLINT UNSIGNED NOT NULL,
    semester_id      TINYINT UNSIGNED  NOT NULL,
    lecturer_id      INT UNSIGNED      DEFAULT NULL,
    section_code     VARCHAR(30)       NOT NULL COMMENT 'VD: WEB302.01',
    max_students     SMALLINT UNSIGNED NOT NULL DEFAULT 40,
    min_students     SMALLINT UNSIGNED NOT NULL DEFAULT 10,
    enrolled_count   SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    grade_status     ENUM('open','submitted','locked','published') NOT NULL DEFAULT 'open',
    status           ENUM('open','closed','cancelled') NOT NULL DEFAULT 'open',
    weight_attendance DECIMAL(3,2)     NOT NULL DEFAULT 0.10 COMMENT 'Trọng số chuyên cần',
    weight_midterm   DECIMAL(3,2)      NOT NULL DEFAULT 0.30 COMMENT 'Trọng số giữa kỳ',
    weight_practice  DECIMAL(3,2)      NOT NULL DEFAULT 0.00 COMMENT 'Trọng số thực hành',
    weight_final     DECIMAL(3,2)      NOT NULL DEFAULT 0.60 COMMENT 'Trọng số cuối kỳ',
    created_at       DATETIME          NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at       DATETIME          NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_section_code (section_code),
    KEY fk_section_course   (course_id),
    KEY fk_section_semester (semester_id),
    KEY fk_section_lecturer (lecturer_id),
    CONSTRAINT fk_section_course   FOREIGN KEY (course_id)   REFERENCES courses   (id),
    CONSTRAINT fk_section_semester FOREIGN KEY (semester_id) REFERENCES semesters (id),
    CONSTRAINT fk_section_lecturer FOREIGN KEY (lecturer_id) REFERENCES lecturers (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─────────────────────────────────────────────
-- 13. section_schedules (Lịch học của lớp học phần)
-- ─────────────────────────────────────────────
CREATE TABLE section_schedules (
    id             INT UNSIGNED      NOT NULL AUTO_INCREMENT,
    section_id     INT UNSIGNED      NOT NULL,
    room_id        SMALLINT UNSIGNED DEFAULT NULL,
    day_of_week    TINYINT UNSIGNED  NOT NULL COMMENT '2=Thứ 2 … 7=Thứ 7, 1=CN',
    period_start   TINYINT UNSIGNED  NOT NULL COMMENT 'Tiết bắt đầu (1-12)',
    period_end     TINYINT UNSIGNED  NOT NULL COMMENT 'Tiết kết thúc (1-12)',
    time_start     TIME              NOT NULL COMMENT 'VD: 07:00:00',
    time_end       TIME              NOT NULL COMMENT 'VD: 09:30:00',
    effective_from DATE              NOT NULL,
    effective_to   DATE              NOT NULL,
    created_at     DATETIME          NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at     DATETIME          NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY fk_schedule_section (section_id),
    KEY fk_schedule_room    (room_id),
    CONSTRAINT fk_schedule_section FOREIGN KEY (section_id) REFERENCES course_sections (id),
    CONSTRAINT fk_schedule_room    FOREIGN KEY (room_id)    REFERENCES rooms           (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─────────────────────────────────────────────
-- 14. enrollments (Đăng ký học phần)
-- ─────────────────────────────────────────────
CREATE TABLE enrollments (
    id                    INT UNSIGNED NOT NULL AUTO_INCREMENT,
    student_id            INT UNSIGNED NOT NULL,
    section_id            INT UNSIGNED NOT NULL,
    registration_period_id INT UNSIGNED DEFAULT NULL,
    status                ENUM('enrolled','cancelled','dropped') NOT NULL DEFAULT 'enrolled',
    enrolled_at           DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    cancelled_at          DATETIME     DEFAULT NULL,
    created_at            DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at            DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_enrollment (student_id, section_id),
    KEY fk_enroll_section (section_id),
    KEY fk_enroll_period  (registration_period_id),
    CONSTRAINT fk_enroll_student FOREIGN KEY (student_id)             REFERENCES students             (id),
    CONSTRAINT fk_enroll_section FOREIGN KEY (section_id)             REFERENCES course_sections      (id),
    CONSTRAINT fk_enroll_period  FOREIGN KEY (registration_period_id) REFERENCES registration_periods (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─────────────────────────────────────────────
-- 15. grades (Điểm học phần)
-- ─────────────────────────────────────────────
CREATE TABLE grades (
    id               INT UNSIGNED NOT NULL AUTO_INCREMENT,
    enrollment_id    INT UNSIGNED NOT NULL,
    score_attendance DECIMAL(4,2) DEFAULT NULL COMMENT 'Điểm chuyên cần (0–10)',
    score_midterm    DECIMAL(4,2) DEFAULT NULL COMMENT 'Điểm giữa kỳ (0–10)',
    score_practice   DECIMAL(4,2) DEFAULT NULL COMMENT 'Điểm thực hành (0–10)',
    score_final      DECIMAL(4,2) DEFAULT NULL COMMENT 'Điểm cuối kỳ (0–10)',
    score_total_10   DECIMAL(4,2) DEFAULT NULL COMMENT 'Điểm tổng kết thang 10',
    score_letter     VARCHAR(2)   DEFAULT NULL COMMENT 'A, B+, B, C+, C, D+, D, F',
    score_gpa        DECIMAL(3,2) DEFAULT NULL COMMENT 'Điểm GPA thang 4',
    status           ENUM('draft','submitted','locked','published') NOT NULL DEFAULT 'draft',
    is_retake        TINYINT(1)   NOT NULL DEFAULT 0 COMMENT 'Học lại: 1=có',
    created_at       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_grades_enrollment (enrollment_id),
    CONSTRAINT fk_grades_enrollment FOREIGN KEY (enrollment_id) REFERENCES enrollments (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─────────────────────────────────────────────
-- 16. attendance_records (Điểm danh)
-- ─────────────────────────────────────────────
CREATE TABLE attendance_records (
    id            INT UNSIGNED NOT NULL AUTO_INCREMENT,
    enrollment_id INT UNSIGNED NOT NULL,
    session_date  DATE         NOT NULL,
    session_no    TINYINT UNSIGNED NOT NULL COMMENT 'Buổi thứ mấy trong môn học',
    status        ENUM('present','absent','late','excused') NOT NULL DEFAULT 'present',
    note          VARCHAR(255) DEFAULT NULL,
    created_at    DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at    DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_attendance (enrollment_id, session_date, session_no),
    CONSTRAINT fk_attend_enrollment FOREIGN KEY (enrollment_id) REFERENCES enrollments (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─────────────────────────────────────────────
-- 17. notifications (Thông báo)
-- ─────────────────────────────────────────────
CREATE TABLE notifications (
    id           INT UNSIGNED NOT NULL AUTO_INCREMENT,
    created_by   INT UNSIGNED NOT NULL,
    title        VARCHAR(255) NOT NULL,
    content      TEXT         NOT NULL,
    scope        ENUM('all','department','section','student') NOT NULL DEFAULT 'all',
    scope_id     INT UNSIGNED DEFAULT NULL COMMENT 'ID của department/section/student',
    priority     ENUM('normal','important','urgent') NOT NULL DEFAULT 'normal',
    published_at DATETIME     DEFAULT NULL,
    created_at   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY fk_notif_creator (created_by),
    CONSTRAINT fk_notif_creator FOREIGN KEY (created_by) REFERENCES users (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─────────────────────────────────────────────
-- 18. notification_recipients
-- ─────────────────────────────────────────────
CREATE TABLE notification_recipients (
    id              INT UNSIGNED NOT NULL AUTO_INCREMENT,
    notification_id INT UNSIGNED NOT NULL,
    user_id         INT UNSIGNED NOT NULL,
    is_read         TINYINT(1)   NOT NULL DEFAULT 0,
    read_at         DATETIME     DEFAULT NULL,
    created_at      DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_notif_recipient (notification_id, user_id),
    KEY fk_nrecip_user (user_id),
    CONSTRAINT fk_nrecip_notif FOREIGN KEY (notification_id) REFERENCES notifications (id) ON DELETE CASCADE,
    CONSTRAINT fk_nrecip_user  FOREIGN KEY (user_id)         REFERENCES users         (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─────────────────────────────────────────────
-- 19. personal_access_tokens (Laravel Sanctum)
-- ─────────────────────────────────────────────
CREATE TABLE personal_access_tokens (
    id             BIGINT UNSIGNED  NOT NULL AUTO_INCREMENT,
    tokenable_type VARCHAR(255)     NOT NULL,
    tokenable_id   BIGINT UNSIGNED  NOT NULL,
    name           VARCHAR(255)     NOT NULL,
    token          VARCHAR(64)      NOT NULL,
    abilities      TEXT             DEFAULT NULL,
    last_used_at   DATETIME         DEFAULT NULL,
    expires_at     DATETIME         DEFAULT NULL,
    created_at     DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at     DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_pat_token (token),
    KEY idx_pat_tokenable (tokenable_type, tokenable_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- PHẦN 2: DỮ LIỆU MẪU (SEED DATA)
-- ============================================================


-- ─────────────────────────────────────────────
-- roles
-- ─────────────────────────────────────────────
INSERT INTO roles (id, name, display_name) VALUES
(1, 'admin',    'Quản trị viên / Phòng Đào tạo'),
(2, 'lecturer', 'Giảng viên'),
(3, 'student',  'Sinh viên');

-- ─────────────────────────────────────────────
-- departments
-- ─────────────────────────────────────────────
INSERT INTO departments (id, code, name, head_name, email, phone, status) VALUES
(1,'CNTT', 'Khoa Công nghệ Thông tin',   'PGS.TS. Nguyễn Văn Hùng', 'cntt@huce.edu.vn',  '024.3869.4201','active'),
(2,'KTXD', 'Khoa Kỹ thuật Xây dựng',    'GS.TS. Trần Minh Đức',    'ktxd@huce.edu.vn',  '024.3869.4202','active'),
(3,'QTKD', 'Khoa Quản trị Kinh doanh',  'TS. Lê Thị Mai',           'qtkd@huce.edu.vn',  '024.3869.4203','active'),
(4,'TOAN', 'Khoa Toán – Tin',            'PGS.TS. Phạm Thanh Liêm', 'toan@huce.edu.vn',  '024.3869.4204','active'),
(5,'NGOAI','Khoa Ngoại ngữ',             'ThS. Vũ Thu Hương',        'ngoai@huce.edu.vn', '024.3869.4205','active');

-- ─────────────────────────────────────────────
-- majors
-- ─────────────────────────────────────────────
INSERT INTO majors (id, department_id, code, name, total_credits, duration_years, status) VALUES
(1,1,'CNTT01','Công nghệ Thông tin',  130,4,'active'),
(2,1,'HTTT01','Hệ thống Thông tin',   130,4,'active'),
(3,2,'KTXD01','Kỹ thuật Xây dựng',   140,5,'active'),
(4,3,'QTKD01','Quản trị Kinh doanh', 125,4,'active'),
(5,1,'ATTT01','An toàn Thông tin',   132,4,'active');

-- ─────────────────────────────────────────────
-- users
-- Mật khẩu: Password@123
-- Hash bcrypt Laravel: $2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC
-- ─────────────────────────────────────────────
INSERT INTO users (id, username, email, password, role_id, status) VALUES
-- Admin
(1,  'admin',          'admin@edumanager.vn',              '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 1, 'active'),
(2,  'phongdaotao',    'daotao@edumanager.vn',             '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 1, 'active'),
-- Giảng viên
(3,  'gv.minhanh',     'nguyen.minhanh@huce.edu.vn',       '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 2, 'active'),
(4,  'gv.thuha',       'tran.thuha@huce.edu.vn',           '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 2, 'active'),
(5,  'gv.hoangnam',    'le.hoangnam@huce.edu.vn',          '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 2, 'active'),
(6,  'gv.vanthang',    'pham.vanthang@huce.edu.vn',        '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 2, 'active'),
(7,  'gv.thibich',     'nguyen.thibich@huce.edu.vn',       '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 2, 'active'),
(8,  'gv.quynhnga',    'do.quynhnga@huce.edu.vn',          '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 2, 'active'),
(9,  'gv.truongan',    'hoang.truongan@huce.edu.vn',       '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 2, 'active'),
(10, 'gv.minhkhoa',    'bui.minhkhoa@huce.edu.vn',         '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 2, 'active'),
-- Sinh viên K67-2022
(11, 'sv.nguyen.an',   '22a10001@student.huce.edu.vn',     '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 3, 'active'),
(12, 'sv.tran.linh',   '22a10002@student.huce.edu.vn',     '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 3, 'active'),
(13, 'sv.le.tung',     '22a10003@student.huce.edu.vn',     '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 3, 'active'),
(14, 'sv.pham.my',     '22a10004@student.huce.edu.vn',     '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 3, 'active'),
(15, 'sv.hoang.duc',   '22a10005@student.huce.edu.vn',     '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 3, 'active'),
(16, 'sv.vu.phuong',   '22a10006@student.huce.edu.vn',     '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 3, 'active'),
(17, 'sv.dang.tuan',   '22a10007@student.huce.edu.vn',     '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 3, 'active'),
(18, 'sv.bui.nga',     '22a10008@student.huce.edu.vn',     '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 3, 'active'),
(19, 'sv.do.khanh',    '22a10009@student.huce.edu.vn',     '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 3, 'active'),
(20, 'sv.ngo.hai',     '22a10010@student.huce.edu.vn',     '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 3, 'active'),
-- Sinh viên K66-2021
(21, 'sv.trinh.lan',   '21a10001@student.huce.edu.vn',     '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 3, 'active'),
(22, 'sv.ly.minh',     '21a10002@student.huce.edu.vn',     '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 3, 'active'),
(23, 'sv.cao.son',     '21a10003@student.huce.edu.vn',     '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 3, 'active'),
-- Sinh viên K68-2023
(24, 'sv.dinh.anh',    '23a10001@student.huce.edu.vn',     '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 3, 'active'),
(25, 'sv.nguyen.son',  '23a10002@student.huce.edu.vn',     '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 3, 'active'),
(26, 'sv.tran.trang',  '23a10003@student.huce.edu.vn',     '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 3, 'active'),
(27, 'sv.le.bach',     '23a10004@student.huce.edu.vn',     '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 3, 'active'),
-- Sinh viên K67-ngành HTTT
(28, 'sv.pham.nhat',   '22b10001@student.huce.edu.vn',     '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 3, 'active'),
(29, 'sv.hoang.giang', '22b10002@student.huce.edu.vn',     '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 3, 'active'),
(30, 'sv.vu.nam',      '22b10003@student.huce.edu.vn',     '$2y$12$LtQCDcOhCiIRCVwZNVJuSuqj.0sIDAOAeqVVHb3qpXqeFezYWKJFC', 3, 'active');

-- ─────────────────────────────────────────────
-- lecturers
-- ─────────────────────────────────────────────
INSERT INTO lecturers (id, user_id, department_id, lecturer_code, full_name, gender, date_of_birth, phone, email_work, academic_rank, specialization, status) VALUES
(1,  3,  1,'GV001','Nguyễn Minh Anh', 'Nam','1980-05-12','0901234501','nguyen.minhanh@huce.edu.vn', 'TS',    'Lập trình Web, Phát triển Phần mềm',       'active'),
(2,  4,  1,'GV002','Trần Thu Hà',     'Nữ', '1982-09-20','0901234502','tran.thuha@huce.edu.vn',      'ThS',   'Cơ sở dữ liệu, Khai phá dữ liệu',          'active'),
(3,  5,  1,'GV003','Lê Hoàng Nam',   'Nam','1979-03-07','0901234503','le.hoangnam@huce.edu.vn',      'PGS.TS','UI/UX, Thiết kế đồ họa số',                 'active'),
(4,  6,  1,'GV004','Phạm Văn Thắng', 'Nam','1975-11-30','0901234504','pham.vanthang@huce.edu.vn',    'GS.TS', 'Mạng máy tính, An ninh mạng',              'active'),
(5,  7,  1,'GV005','Nguyễn Thị Bích','Nữ', '1985-07-15','0901234505','nguyen.thibich@huce.edu.vn',   'ThS',   'Lập trình hướng đối tượng, Java, C#',      'active'),
(6,  8,  4,'GV006','Đỗ Quỳnh Nga',   'Nữ', '1983-02-28','0901234506','do.quynhnga@huce.edu.vn',      'TS',    'Toán rời rạc, Giải tích, Xác suất',        'active'),
(7,  9,  1,'GV007','Hoàng Trường An','Nam','1988-06-21','0901234507','hoang.truongan@huce.edu.vn',   'ThS',   'Trí tuệ nhân tạo, Machine Learning',        'active'),
(8,  10, 1,'GV008','Bùi Minh Khoa',  'Nam','1990-04-10','0901234508','bui.minhkhoa@huce.edu.vn',     'ThS',   'Hệ điều hành, Kiến trúc máy tính',         'active');

-- ─────────────────────────────────────────────
-- students
-- ─────────────────────────────────────────────
INSERT INTO students (id, user_id, major_id, student_code, full_name, gender, date_of_birth, place_of_birth, id_card, phone, home_address, class_name, enrollment_year, course_year, training_type, status, tuition_total, tuition_paid) VALUES
-- K67 / 2022 — Ngành CNTT (major_id=1)
(1,  11, 1,'22A10001','Nguyễn An',        'Nam','2004-03-15','Hà Nội',    '001234567890','0912000001','Số 10 Láng Hạ, Đống Đa, HN',       '22A1',2022,67,'regular','studying',8650000,7400000),
(2,  12, 1,'22A10002','Trần Linh',        'Nữ', '2004-07-22','Nam Định',  '001234567891','0912000002','25 Trần Phú, TP. Nam Định',          '22A1',2022,67,'regular','studying',8650000,8650000),
(3,  13, 1,'22A10003','Lê Tùng',          'Nam','2003-11-05','Hải Phòng', '001234567892','0912000003','78 Điện Biên Phủ, HP',               '22A1',2022,67,'regular','studying',8650000,8650000),
(4,  14, 1,'22A10004','Phạm Mỹ',          'Nữ', '2004-01-30','Hà Nội',    '001234567893','0912000004','45 Giảng Võ, Ba Đình, HN',           '22A1',2022,67,'regular','studying',8650000,6500000),
(5,  15, 1,'22A10005','Hoàng Đức',        'Nam','2004-05-18','Thái Bình', '001234567894','0912000005','12 Lý Thái Tổ, TP. Thái Bình',       '22A1',2022,67,'regular','studying',8650000,8650000),
(6,  16, 1,'22A10006','Vũ Phương',        'Nữ', '2003-09-12','Hà Nội',    '001234567895','0912000006','99 Hoàng Quốc Việt, Cầu Giấy, HN',  '22A2',2022,67,'regular','studying',8650000,8650000),
(7,  17, 1,'22A10007','Đặng Tuấn',        'Nam','2004-04-25','Nghệ An',   '001234567896','0912000007','56 Nguyễn Trãi, TP. Vinh',           '22A2',2022,67,'regular','studying',8650000,8650000),
-- K67 / 2022 — Ngành HTTT (major_id=2)
(8,  18, 2,'22A10008','Bùi Nga',          'Nữ', '2004-02-08','Hà Nội',    '001234567897','0912000008','33 Kim Mã, Ba Đình, HN',             '22B1',2022,67,'regular','studying',8200000,8200000),
(9,  19, 2,'22A10009','Đỗ Khánh',         'Nam','2003-12-19','Vĩnh Phúc', '001234567898','0912000009','88 Hai Bà Trưng, VP',                '22B1',2022,67,'regular','studying',8200000,8200000),
(10, 20, 2,'22A10010','Ngô Hải',          'Nam','2004-06-03','Hưng Yên',  '001234567899','0912000010','15 Phố Hiến, TP. Hưng Yên',          '22B1',2022,67,'regular','studying',8200000,7000000),
-- K66 / 2021 — Ngành CNTT
(11, 21, 1,'21A10001','Trịnh Lan',        'Nữ', '2003-08-14','Hà Nội',    '001234567900','0912000011','7 Trần Duy Hưng, Cầu Giấy, HN',     '21A1',2021,66,'regular','studying',8650000,8650000),
(12, 22, 1,'21A10002','Lý Minh',          'Nam','2003-02-27','Thanh Hóa', '001234567901','0912000012','62 Lê Lợi, TP. Thanh Hóa',           '21A1',2021,66,'regular','studying',8650000,8650000),
(13, 23, 1,'21A10003','Cao Sơn',          'Nam','2002-10-11','Hà Nội',    '001234567902','0912000013','20 Nguyễn Chí Thanh, Đống Đa, HN',  '21A2',2021,66,'regular','studying',8650000,8650000),
-- K68 / 2023 — Ngành CNTT
(14, 24, 1,'23A10001','Đinh Anh',         'Nam','2005-01-20','Hải Dương', '001234567903','0912000014','44 Trần Hưng Đạo, HD',               '23A1',2023,68,'regular','studying',8650000,8650000),
(15, 25, 1,'23A10002','Nguyễn Sơn',       'Nam','2005-03-09','Phú Thọ',   '001234567904','0912000015','8 Hùng Vương, TP. Việt Trì',         '23A1',2023,68,'regular','studying',8650000,4000000),
(16, 26, 1,'23A10003','Trần Trang',       'Nữ', '2005-07-16','Hà Nội',    '001234567905','0912000016','55 Đội Cấn, Ba Đình, HN',            '23A1',2023,68,'regular','studying',8650000,8650000),
(17, 27, 1,'23A10004','Lê Bách',          'Nam','2005-09-23','Nam Định',  '001234567906','0912000017','30 Nguyễn Du, TP. Nam Định',         '23A2',2023,68,'regular','studying',8650000,8650000),
-- K67 / 2022 — Ngành HTTT (tiếp)
(18, 28, 2,'22B10001','Phạm Nhật',        'Nam','2004-04-04','Hà Nội',    '001234567907','0912000018','11 Xuân Thủy, Cầu Giấy, HN',        '22C1',2022,67,'regular','studying',8200000,8200000),
(19, 29, 2,'22B10002','Hoàng Giang',      'Nữ', '2004-08-17','Bắc Ninh',  '001234567908','0912000019','5 Lý Thái Tổ, TP. Bắc Ninh',        '22C1',2022,67,'regular','studying',8200000,8200000),
(20, 30, 2,'22B10003','Vũ Nam',           'Nam','2003-12-30','Hà Nội',    '001234567909','0912000020','17 Láng, Đống Đa, HN',               '22C1',2022,67,'regular','studying',8200000,8200000);

-- ─────────────────────────────────────────────
-- courses
-- ─────────────────────────────────────────────
INSERT INTO courses (id, department_id, course_code, name, credits, theory_hours, practice_hours, status) VALUES
(1, 1,'INT101','Nhập môn Lập trình',                 3,30,15,'active'),
(2, 1,'INT102','Lập trình hướng đối tượng',          3,30,15,'active'),
(3, 1,'DBI101','Nhập môn Cơ sở dữ liệu',            2,20,10,'active'),
(4, 1,'DBI202','Cơ sở dữ liệu nâng cao',            3,30,15,'active'),
(5, 1,'WEB301','Phát triển Web cơ bản',              3,30,15,'active'),
(6, 1,'WEB302','Lập trình Web',                      3,25,20,'active'),
(7, 1,'UXD201','Thiết kế giao diện người dùng',      3,25,20,'active'),
(8, 1,'NET301','Mạng máy tính',                      3,30,15,'active'),
(9, 1,'NET401','An toàn mạng',                       3,30,15,'active'),
(10,1,'ALG201','Cấu trúc dữ liệu và Giải thuật',    3,30,15,'active'),
(11,1,'AI301', 'Trí tuệ nhân tạo',                  3,30,15,'active'),
(12,1,'ML401', 'Học máy',                            3,25,20,'active'),
(13,1,'OS201', 'Hệ điều hành',                      3,30,15,'active'),
(14,1,'SE301', 'Công nghệ phần mềm',                 3,30,15,'active'),
(15,1,'PRJ401','Đồ án tốt nghiệp',                   5, 0,75,'active'),
(16,4,'MTH101','Giải tích 1',                        4,45,15,'active'),
(17,4,'MTH102','Đại số tuyến tính',                  3,30,15,'active'),
(18,4,'MTH201','Xác suất – Thống kê',               3,30,15,'active'),
(19,5,'ENG101','Tiếng Anh cơ bản 1',               3,30,15,'active'),
(20,5,'ENG201','Tiếng Anh chuyên ngành CNTT',       2,20,10,'active');

-- ─────────────────────────────────────────────
-- course_prerequisites
-- ─────────────────────────────────────────────
INSERT INTO course_prerequisites (course_id, prerequisite_id, type) VALUES
(2,  1,  'prerequisite'), -- OOP ← Nhập môn LP
(4,  3,  'prerequisite'), -- DB nâng cao ← DB nhập môn
(6,  5,  'prerequisite'), -- Lập trình Web ← Web cơ bản
(7,  5,  'prerequisite'), -- UX ← Web cơ bản
(9,  8,  'prerequisite'), -- An toàn mạng ← Mạng máy tính
(10, 1,  'prerequisite'), -- CTDL ← Nhập môn LP
(11, 10, 'prerequisite'), -- AI ← CTDL
(12, 11, 'prerequisite'), -- ML ← AI
(13, 2,  'prerequisite'), -- CNPM ← OOP
(15, 14, 'prerequisite'), -- Đồ án ← CNPM
(20, 19, 'prerequisite'); -- TA chuyên ngành ← TA cơ bản

-- ─────────────────────────────────────────────
-- rooms
-- ─────────────────────────────────────────────
INSERT INTO rooms (id, room_code, building, capacity, type, status) VALUES
(1, 'A101','Nhà A', 50,'theory','available'),
(2, 'A102','Nhà A', 50,'theory','available'),
(3, 'A201','Nhà A', 45,'theory','available'),
(4, 'A203','Nhà A', 45,'theory','available'),
(5, 'B101','Nhà B', 60,'theory','available'),
(6, 'B105','Nhà B', 60,'theory','available'),
(7, 'B201','Nhà B', 40,'theory','available'),
(8, 'B205','Nhà B', 40,'theory','available'),
(9, 'C301','Nhà C', 35,'lab',   'available'),
(10,'C302','Nhà C', 35,'lab',   'available'),
(11,'C303','Nhà C', 35,'lab',   'available'),
(12,'D101','Nhà D',100,'theory','available'),
(13,'D201','Nhà D', 80,'seminar','available');

-- ─────────────────────────────────────────────
-- semesters
-- ─────────────────────────────────────────────
INSERT INTO semesters (id, code, name, academic_year, semester_number, start_date, end_date, status) VALUES
(1,'HK2-2024-2025','Học kỳ 2 · 2024–2025', '2024-2025',2,'2025-01-06','2025-05-25','closed'),
(2,'HK3-2024-2025','Học kỳ hè · 2024–2025','2024-2025',3,'2025-06-09','2025-08-10','closed'),
(3,'HK1-2025-2026','Học kỳ 1 · 2025–2026', '2025-2026',1,'2025-09-01','2026-01-10','closed'),
(4,'HK2-2025-2026','Học kỳ 2 · 2025–2026', '2025-2026',2,'2026-01-19','2026-05-30','closed'),
(5,'HK1-2026-2027','Học kỳ 1 · 2026–2027', '2026-2027',1,'2026-09-01','2027-01-10','active'),
(6,'HK2-2026-2027','Học kỳ 2 · 2026–2027', '2026-2027',2,'2027-01-18','2027-05-28','upcoming');

-- ─────────────────────────────────────────────
-- registration_periods
-- ─────────────────────────────────────────────
INSERT INTO registration_periods (id, semester_id, name, registration_start, registration_end, min_credits, max_credits, status, notes) VALUES
(1,5,'Đợt 1 – Đăng ký chính thức HK1 2026-2027','2026-08-01 07:00:00','2026-08-20 23:59:00',10,24,'open',   'Sinh viên ưu tiên: K66 trước, K67, K68 sau'),
(2,5,'Đợt 2 – Đăng ký bổ sung HK1 2026-2027',   '2026-08-25 07:00:00','2026-09-05 23:59:00', 1,24,'upcoming','Dành cho sinh viên bổ sung, học lại'),
(3,4,'Đợt 1 – Đăng ký chính thức HK2 2025-2026', '2025-12-15 07:00:00','2026-01-05 23:59:00',10,24,'closed', NULL);

-- ─────────────────────────────────────────────
-- course_sections
-- ─────────────────────────────────────────────
INSERT INTO course_sections (id, course_id, semester_id, lecturer_id, section_code, max_students, min_students, enrolled_count, grade_status, status, weight_attendance, weight_midterm, weight_practice, weight_final) VALUES
-- HK1-2026-2027 (semester_id=5) — đang mở
(1,  6, 5,1,'WEB302.01',40,10,32,'open','open',0.10,0.30,0.00,0.60),
(2,  6, 5,1,'WEB302.02',40,10,28,'open','open',0.10,0.30,0.00,0.60),
(3,  4, 5,2,'DBI202.01',35,10,30,'open','open',0.10,0.30,0.00,0.60),
(4,  4, 5,2,'DBI202.02',35,10,25,'open','open',0.10,0.30,0.00,0.60),
(5,  7, 5,3,'UXD201.01',30,10,27,'open','open',0.10,0.30,0.10,0.50),
(6, 10, 5,5,'ALG201.01',40,10,35,'open','open',0.10,0.30,0.00,0.60),
(7,  8, 5,4,'NET301.01',40,10,33,'open','open',0.10,0.30,0.00,0.60),
(8, 11, 5,7,'AI301.01', 30,10,20,'open','open',0.10,0.30,0.10,0.50),
(9, 13, 5,8,'OS201.01', 40,10,38,'open','open',0.10,0.30,0.00,0.60),
(10,14, 5,5,'SE301.01', 35,10,29,'open','open',0.10,0.30,0.00,0.60),
(11,16, 5,6,'MTH101.01',50,15,45,'open','open',0.10,0.30,0.00,0.60),
(12,17, 5,6,'MTH102.01',50,15,42,'open','open',0.10,0.30,0.00,0.60),
(13,19, 5,NULL,'ENG101.01',45,15,40,'open','open',0.10,0.30,0.00,0.60),
(14, 2, 5,5,'INT102.01',40,10,10,'open','open',0.10,0.30,0.00,0.60),
(15,20, 5,NULL,'ENG201.01',30,10, 8,'open','open',0.10,0.30,0.00,0.60),
-- HK2-2025-2026 (semester_id=4) — đã có điểm published
(16, 5, 4,1,'WEB301.01',40,10,35,'published','closed',0.10,0.30,0.00,0.60),
(17, 3, 4,2,'DBI101.01',40,10,38,'published','closed',0.10,0.30,0.00,0.60),
(18, 1, 4,5,'INT101.01',50,15,48,'published','closed',0.10,0.30,0.00,0.60),
(19,16, 4,6,'MTH101.02',50,15,46,'published','closed',0.10,0.30,0.00,0.60),
(20,18, 4,6,'MTH201.01',45,15,42,'published','closed',0.10,0.30,0.00,0.60);

-- ─────────────────────────────────────────────
-- section_schedules
-- ─────────────────────────────────────────────
-- day_of_week: 2=Thứ 2, 3=Thứ 3, 4=Thứ 4, 5=Thứ 5, 6=Thứ 6, 7=Thứ 7
-- Tiết: 1-3 (07:00-09:30) | 4-6 (09:45-12:15) | 7-9 (13:00-15:30)
INSERT INTO section_schedules (section_id, room_id, day_of_week, period_start, period_end, time_start, time_end, effective_from, effective_to) VALUES
-- HK1-2026-2027
(1, 4, 3,1,3,'07:00:00','09:30:00','2026-09-01','2027-01-10'), -- WEB302.01 Thứ 3 A203
(2, 3, 5,4,6,'09:45:00','12:15:00','2026-09-01','2027-01-10'), -- WEB302.02 Thứ 5 A201
(3, 6, 4,4,6,'09:45:00','12:15:00','2026-09-01','2027-01-10'), -- DBI202.01 Thứ 4 B105
(4, 7, 2,1,3,'07:00:00','09:30:00','2026-09-01','2027-01-10'), -- DBI202.02 Thứ 2 B201
(5,10, 5,7,9,'13:00:00','15:30:00','2026-09-01','2027-01-10'), -- UXD201.01 Thứ 5 C302
(6, 5, 2,4,6,'09:45:00','12:15:00','2026-09-01','2027-01-10'), -- ALG201.01 Thứ 2 B101
(7, 1, 3,7,9,'13:00:00','15:30:00','2026-09-01','2027-01-10'), -- NET301.01 Thứ 3 A101
(8, 9, 6,1,3,'07:00:00','09:30:00','2026-09-01','2027-01-10'), -- AI301.01  Thứ 6 C301
(9, 2, 4,7,9,'13:00:00','15:30:00','2026-09-01','2027-01-10'), -- OS201.01  Thứ 4 A102
(10,8, 5,1,3,'07:00:00','09:30:00','2026-09-01','2027-01-10'), -- SE301.01  Thứ 5 B205
(11,12,2,7,9,'13:00:00','15:30:00','2026-09-01','2027-01-10'), -- MTH101.01 Thứ 2 D101
(12,12,3,4,6,'09:45:00','12:15:00','2026-09-01','2027-01-10'), -- MTH102.01 Thứ 3 D101
(13,5, 4,1,3,'07:00:00','09:30:00','2026-09-01','2027-01-10'), -- ENG101.01 Thứ 4 B101
(14,3, 6,4,6,'09:45:00','12:15:00','2026-09-01','2027-01-10'), -- INT102.01 Thứ 6 A201
(15,11,6,7,9,'13:00:00','15:30:00','2026-09-01','2027-01-10'), -- ENG201.01 Thứ 6 C303
-- HK2-2025-2026
(16,4, 3,1,3,'07:00:00','09:30:00','2026-01-19','2026-05-30'),
(17,6, 4,4,6,'09:45:00','12:15:00','2026-01-19','2026-05-30'),
(18,1, 2,1,3,'07:00:00','09:30:00','2026-01-19','2026-05-30'),
(19,12,5,7,9,'13:00:00','15:30:00','2026-01-19','2026-05-30'),
(20,7, 2,7,9,'13:00:00','15:30:00','2026-01-19','2026-05-30');

-- ─────────────────────────────────────────────
-- enrollments
-- ─────────────────────────────────────────────
-- Student 1 (Nguyễn An) đăng ký 6 lớp HK1-2026-2027 + 5 lớp HK2-2025-2026
INSERT INTO enrollments (id, student_id, section_id, registration_period_id, status, enrolled_at) VALUES
-- ── HK1-2026-2027 ──
-- Student 1 (Nguyễn An): WEB302.01, DBI202.01, UXD201.01, ALG201.01, NET301.01, MTH101.01
(1, 1, 1, 1,'enrolled','2026-08-05 09:00:00'),
(2, 1, 3, 1,'enrolled','2026-08-05 09:01:00'),
(3, 1, 5, 1,'enrolled','2026-08-05 09:02:00'),
(4, 1, 6, 1,'enrolled','2026-08-05 09:03:00'),
(5, 1, 7, 1,'enrolled','2026-08-05 09:04:00'),
(6, 1,11, 1,'enrolled','2026-08-05 09:05:00'),
-- Student 2 (Trần Linh)
(7, 2, 1, 1,'enrolled','2026-08-05 09:10:00'),
(8, 2, 4, 1,'enrolled','2026-08-05 09:11:00'),
(9, 2, 6, 1,'enrolled','2026-08-05 09:12:00'),
(10,2, 9, 1,'enrolled','2026-08-05 09:13:00'),
(11,2,12, 1,'enrolled','2026-08-05 09:14:00'),
(12,2,13, 1,'enrolled','2026-08-05 09:15:00'),
-- Student 3 (Lê Tùng)
(13,3, 2, 1,'enrolled','2026-08-05 09:20:00'),
(14,3, 3, 1,'enrolled','2026-08-05 09:21:00'),
(15,3, 7, 1,'enrolled','2026-08-05 09:22:00'),
(16,3, 8, 1,'enrolled','2026-08-05 09:23:00'),
(17,3,11, 1,'enrolled','2026-08-05 09:24:00'),
(18,3,12, 1,'enrolled','2026-08-05 09:25:00'),
-- Student 4 (Phạm Mỹ)
(19,4, 1, 1,'enrolled','2026-08-05 09:30:00'),
(20,4, 5, 1,'enrolled','2026-08-05 09:31:00'),
(21,4, 6, 1,'enrolled','2026-08-05 09:32:00'),
(22,4,10, 1,'enrolled','2026-08-05 09:33:00'),
(23,4,11, 1,'enrolled','2026-08-05 09:34:00'),
-- Student 5 (Hoàng Đức)
(24,5, 2, 1,'enrolled','2026-08-05 09:40:00'),
(25,5, 4, 1,'enrolled','2026-08-05 09:41:00'),
(26,5, 7, 1,'enrolled','2026-08-05 09:42:00'),
(27,5, 9, 1,'enrolled','2026-08-05 09:43:00'),
(28,5,13, 1,'enrolled','2026-08-05 09:44:00'),
(29,5,14, 1,'enrolled','2026-08-05 09:45:00'),
-- Students 6-10
(30,6, 1, 1,'enrolled','2026-08-06 10:00:00'),
(31,6, 3, 1,'enrolled','2026-08-06 10:01:00'),
(32,6, 6, 1,'enrolled','2026-08-06 10:02:00'),
(33,6,11, 1,'enrolled','2026-08-06 10:03:00'),
(34,7, 2, 1,'enrolled','2026-08-06 10:10:00'),
(35,7, 4, 1,'enrolled','2026-08-06 10:11:00'),
(36,7, 5, 1,'enrolled','2026-08-06 10:12:00'),
(37,7,12, 1,'enrolled','2026-08-06 10:13:00'),
(38,8, 1, 1,'enrolled','2026-08-06 10:20:00'),
(39,8, 3, 1,'enrolled','2026-08-06 10:21:00'),
(40,8, 7, 1,'enrolled','2026-08-06 10:22:00'),
(41,8,11, 1,'enrolled','2026-08-06 10:23:00'),
(42,9, 2, 1,'enrolled','2026-08-06 10:30:00'),
(43,9, 5, 1,'enrolled','2026-08-06 10:31:00'),
(44,9, 9, 1,'enrolled','2026-08-06 10:32:00'),
(45,9,13, 1,'enrolled','2026-08-06 10:33:00'),
(46,10,1, 1,'enrolled','2026-08-06 10:40:00'),
(47,10,6, 1,'enrolled','2026-08-06 10:41:00'),
(48,10,8, 1,'enrolled','2026-08-06 10:42:00'),
(49,10,12,1,'enrolled','2026-08-06 10:43:00'),
-- ── HK2-2025-2026 (sections 16-20, period 3) ──
-- Student 1
(50,1,16,3,'enrolled','2026-01-02 08:00:00'),
(51,1,17,3,'enrolled','2026-01-02 08:01:00'),
(52,1,18,3,'enrolled','2026-01-02 08:02:00'),
(53,1,19,3,'enrolled','2026-01-02 08:03:00'),
(54,1,20,3,'enrolled','2026-01-02 08:04:00'),
-- Student 2
(55,2,16,3,'enrolled','2026-01-02 08:10:00'),
(56,2,17,3,'enrolled','2026-01-02 08:11:00'),
(57,2,18,3,'enrolled','2026-01-02 08:12:00'),
(58,2,20,3,'enrolled','2026-01-02 08:13:00'),
-- Student 3
(59,3,16,3,'enrolled','2026-01-02 08:20:00'),
(60,3,18,3,'enrolled','2026-01-02 08:21:00'),
(61,3,19,3,'enrolled','2026-01-02 08:22:00'),
-- Student 4
(62,4,17,3,'enrolled','2026-01-02 08:30:00'),
(63,4,18,3,'enrolled','2026-01-02 08:31:00'),
(64,4,19,3,'enrolled','2026-01-02 08:32:00'),
(65,4,20,3,'enrolled','2026-01-02 08:33:00'),
-- Student 5
(66,5,16,3,'enrolled','2026-01-02 08:40:00'),
(67,5,17,3,'enrolled','2026-01-02 08:41:00'),
(68,5,19,3,'enrolled','2026-01-02 08:42:00'),
(69,5,20,3,'enrolled','2026-01-02 08:43:00');

-- ─────────────────────────────────────────────
-- grades (HK2-2025-2026 đã published)
-- Công thức: total = att*0.1 + mid*0.3 + fin*0.6
-- Thang chữ: A(≥8.5) B+(≥8.0) B(≥7.0) C+(≥6.5) C(≥5.5) D+(≥5.0) D(≥4.0) F
-- ─────────────────────────────────────────────
INSERT INTO grades (enrollment_id, score_attendance, score_midterm, score_practice, score_final, score_total_10, score_letter, score_gpa, status, is_retake) VALUES
-- Student 1 (Nguyễn An) — enroll 50-54
(50, 9.0, 8.5, NULL, 8.2, 8.42, 'B+', 3.5, 'published', 0), -- WEB301
(51, 9.5, 8.0, NULL, 8.0, 8.35, 'B+', 3.5, 'published', 0), -- DBI101
(52, 9.0, 8.5, NULL, 8.5, 8.65, 'A',  4.0, 'published', 0), -- INT101
(53, 8.5, 7.5, NULL, 7.0, 7.45, 'B',  3.0, 'published', 0), -- MTH101
(54, 8.0, 7.0, NULL, 7.5, 7.55, 'B',  3.0, 'published', 0), -- MTH201

-- Student 2 (Trần Linh) — enroll 55-58
(55, 8.5, 7.5, NULL, 7.0, 7.40, 'B',  3.0, 'published', 0),
(56, 9.0, 8.0, NULL, 7.5, 7.95, 'B',  3.0, 'published', 0),
(57, 8.0, 7.0, NULL, 6.5, 6.95, 'C+', 2.5, 'published', 0),
(58, 7.5, 6.5, NULL, 7.0, 6.95, 'C+', 2.5, 'published', 0),

-- Student 3 (Lê Tùng) — enroll 59-61
(59, 7.0, 6.5, NULL, 6.0, 6.35, 'C',  2.0, 'published', 0),
(60, 8.0, 7.5, NULL, 7.0, 7.30, 'B',  3.0, 'published', 0),
(61, 7.5, 7.0, NULL, 6.5, 6.80, 'C+', 2.5, 'published', 0),

-- Student 4 (Phạm Mỹ) — enroll 62-65
(62, 9.5, 9.0, NULL, 9.0, 9.15, 'A',  4.0, 'published', 0),
(63, 9.0, 8.5, NULL, 9.5, 9.20, 'A',  4.0, 'published', 0),
(64, 8.5, 8.0, NULL, 8.0, 8.20, 'B+', 3.5, 'published', 0),
(65, 9.0, 8.5, NULL, 8.5, 8.65, 'A',  4.0, 'published', 0),

-- Student 5 (Hoàng Đức) — enroll 66-69
(66, 8.0, 7.5, NULL, 6.5, 7.10, 'B',  3.0, 'published', 0),
(67, 8.5, 7.0, NULL, 6.5, 7.00, 'B',  3.0, 'published', 0),
(68, 7.5, 6.5, NULL, 7.0, 6.95, 'C+', 2.5, 'published', 0),
(69, 8.0, 7.5, NULL, 7.0, 7.30, 'B',  3.0, 'published', 0);

-- ─────────────────────────────────────────────
-- attendance_records (mẫu 3 buổi đầu — HK1-2026-2027)
-- ─────────────────────────────────────────────
INSERT INTO attendance_records (enrollment_id, session_date, session_no, status, note) VALUES
(1,'2026-09-02',1,'present',NULL),(1,'2026-09-09',2,'present',NULL),(1,'2026-09-16',3,'present',NULL),
(2,'2026-09-04',1,'present',NULL),(2,'2026-09-11',2,'present',NULL),(2,'2026-09-18',3,'late',   'Đến muộn 10 phút'),
(3,'2026-09-05',1,'present',NULL),(3,'2026-09-12',2,'absent', 'Nghỉ có phép'),(3,'2026-09-19',3,'present',NULL),
(4,'2026-09-02',1,'present',NULL),(4,'2026-09-09',2,'present',NULL),(4,'2026-09-16',3,'present',NULL),
(5,'2026-09-03',1,'present',NULL),(5,'2026-09-10',2,'present',NULL),(5,'2026-09-17',3,'absent', 'Nghỉ ốm'),
(6,'2026-09-02',1,'present',NULL),(6,'2026-09-09',2,'present',NULL),(6,'2026-09-16',3,'present',NULL);

-- ─────────────────────────────────────────────
-- notifications
-- ─────────────────────────────────────────────
INSERT INTO notifications (id, created_by, title, content, scope, scope_id, priority, published_at) VALUES
(1, 1,
 'Mở đợt đăng ký học phần học kỳ 1 năm học 2026–2027',
 'Phòng Đào tạo thông báo mở đợt đăng ký học phần chính thức học kỳ 1 năm học 2026–2027.\n\nThời gian đăng ký: từ 7:00 ngày 01/08/2026 đến 23:59 ngày 20/08/2026.\n\nSinh viên đăng nhập vào cổng thông tin tại địa chỉ: https://student.huce.edu.vn để thực hiện đăng ký.\n\nLưu ý: Sinh viên kiểm tra kỹ điều kiện môn tiên quyết trước khi đăng ký.\n\nMọi thắc mắc liên hệ Phòng Đào tạo, phòng 103 Nhà A.',
 'all', NULL, 'important', '2026-07-28 08:30:00'),
(2, 1,
 'Lịch thi giữa kỳ đã được cập nhật trên cổng sinh viên',
 'Khoa Công nghệ Thông tin thông báo lịch thi giữa kỳ học kỳ 1 năm học 2026–2027 đã được cập nhật.\n\nSinh viên tra cứu lịch thi theo mã lớp học phần tại mục "Thời khóa biểu" trên cổng thông tin sinh viên.\n\nSinh viên có phòng thi khác với phòng học thường xuyên cần chú ý đến địa điểm thi.',
 'department', 1, 'important', '2026-10-15 09:00:00'),
(3, 2,
 'Nhắc nhở hoàn thành học phí trước thời hạn quy định',
 'Phòng Tài chính – Kế toán trân trọng thông báo:\n\nThời hạn hoàn thành học phí học kỳ 1 năm học 2026–2027 là ngày 30/11/2026.\n\nSinh viên chưa đóng đủ học phí sẽ bị khóa tài khoản và không thể đăng ký học phần học kỳ tiếp theo.\n\nHình thức thanh toán: chuyển khoản ngân hàng hoặc nộp trực tiếp tại Phòng Tài chính.',
 'all', NULL, 'urgent', '2026-11-16 08:00:00'),
(4, 1,
 'Thông báo nghỉ Tết Nguyên Đán 2027',
 'Nhà trường thông báo lịch nghỉ Tết Nguyên Đán Đinh Mùi 2027:\n\nNghỉ từ ngày 25/01/2027 (thứ Hai) đến hết ngày 02/02/2027 (thứ Hai).\nHọc lại từ ngày 03/02/2027 (thứ Ba).\n\nLưu ý: Các lớp học phần có lịch thi trong tuần nghỉ sẽ được điều chỉnh. Giảng viên phụ trách sẽ thông báo cụ thể.',
 'all', NULL, 'normal', '2026-11-20 10:00:00'),
(5, 3,
 '[WEB302.01] Thông báo nộp bài tập lớn tuần 10',
 'Thông báo đến các em sinh viên lớp WEB302.01:\n\nBài tập lớn tuần 10 (phát triển tính năng đăng nhập, đăng xuất) cần được nộp trước 23:59 ngày 15/11/2026 qua Google Classroom.\n\nYêu cầu: source code (GitHub link) + báo cáo PDF + demo video (3–5 phút).\n\nSinh viên nộp trễ bị trừ 1 điểm/ngày (tối đa 3 ngày).',
 'section', 1, 'normal', '2026-11-10 07:30:00'),
(6, 1,
 'Hướng dẫn sử dụng cổng thông tin sinh viên EduManager',
 'Phòng Đào tạo hướng dẫn sinh viên sử dụng cổng thông tin EduManager:\n\n1. Đăng nhập tại trang chủ bằng mã sinh viên và mật khẩu.\n2. Đăng ký học phần trong mục "Đăng ký học phần".\n3. Xem thời khóa biểu tại mục "Thời khóa biểu".\n4. Tra cứu điểm tại mục "Kết quả học tập".\n\nMọi vướng mắc liên hệ hỗ trợ kỹ thuật: support@edumanager.vn',
 'all', NULL, 'normal', '2026-08-20 08:00:00');

-- ─────────────────────────────────────────────
-- notification_recipients
-- ─────────────────────────────────────────────
INSERT INTO notification_recipients (notification_id, user_id, is_read, read_at) VALUES
-- Thông báo 1 (mở đăng ký) → tất cả SV (đã đọc)
(1,11,1,'2026-07-28 10:00:00'),(1,12,1,'2026-07-28 11:00:00'),(1,13,0,NULL),(1,14,1,'2026-07-29 08:00:00'),
(1,15,1,'2026-07-28 14:00:00'),(1,16,0,NULL),(1,17,1,'2026-07-30 09:00:00'),(1,18,0,NULL),(1,19,1,'2026-07-28 16:00:00'),(1,20,1,'2026-07-29 10:00:00'),
-- Thông báo 2 (lịch thi giữa kỳ) → SV khoa CNTT
(2,11,1,'2026-10-15 10:00:00'),(2,12,0,NULL),(2,13,1,'2026-10-16 08:00:00'),(2,14,1,'2026-10-15 15:00:00'),
(2,15,0,NULL),(2,16,1,'2026-10-17 09:00:00'),(2,17,1,'2026-10-15 20:00:00'),
-- Thông báo 3 (học phí) → tất cả SV
(3,11,1,'2026-11-16 09:00:00'),(3,12,0,NULL),(3,13,0,NULL),(3,14,1,'2026-11-17 08:00:00'),
(3,15,1,'2026-11-16 12:00:00'),(3,16,0,NULL),(3,17,0,NULL),(3,18,1,'2026-11-18 10:00:00'),(3,19,0,NULL),(3,20,0,NULL),
-- Thông báo 4 (nghỉ Tết)
(4,11,0,NULL),(4,12,0,NULL),(4,13,0,NULL),(4,14,0,NULL),(4,15,0,NULL),
-- Thông báo 5 (WEB302.01) → chỉ SV đăng ký lớp đó (enroll_id 1,7,30,38,46)
(5,11,1,'2026-11-10 08:00:00'),(5,12,0,NULL),(5,16,0,NULL),(5,18,0,NULL),(5,20,0,NULL),
-- Thông báo 6 (hướng dẫn hệ thống)
(6,11,1,'2026-08-20 10:00:00'),(6,12,1,'2026-08-21 09:00:00'),(6,13,0,NULL),(6,14,1,'2026-08-20 15:00:00'),
(6,15,0,NULL),(6,16,1,'2026-08-22 08:00:00'),(6,17,0,NULL),(6,18,0,NULL),(6,19,1,'2026-08-20 11:00:00'),(6,20,0,NULL);

-- ============================================================
-- HOÀN TẤT
-- ============================================================
SET FOREIGN_KEY_CHECKS = 1;

SELECT 'EduManager database created successfully!' AS message;
SELECT 
    TABLE_NAME        AS `Bảng`,
    TABLE_ROWS        AS `Số hàng (ước tính)`,
    TABLE_COMMENT     AS `Ghi chú`
FROM information_schema.TABLES
WHERE TABLE_SCHEMA = 'EduManager'
ORDER BY TABLE_NAME;
