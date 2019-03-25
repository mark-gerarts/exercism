(defpackage #:leap
  (:use #:common-lisp)
  (:export #:leap-year-p))
(in-package #:leap)

(defun leap-year-p (year)
  (and (divisible-by-p year 4)
       (or (not (divisible-by-p year 100))
           (divisible-by-p year 400))))

(defun divisible-by-p (number divisor)
  (= (rem number divisor) 0))
