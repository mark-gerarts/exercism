module Pangram (isPangram) where

import Data.List
import Data.Char

isPangram :: String -> Bool
isPangram = (==['a'..'z']) . sort . nub . map toLower . filter isLetter
