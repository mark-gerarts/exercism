module SpaceAge (Planet(..), ageOn) where

data Planet = Mercury
            | Venus
            | Earth
            | Mars
            | Jupiter
            | Saturn
            | Uranus
            | Neptune

type Seconds = Float

earthYear :: Seconds
earthYear = 60 * 60 * 24 * 365.25

ageOn :: Planet -> Float -> Float
ageOn = normalizeToEarthYear . orbitalPeriod

normalizeToEarthYear :: Float -> Float -> Float
normalizeToEarthYear ratio = (/ (ratio * earthYear))

orbitalPeriod :: Planet -> Float
orbitalPeriod planet = case planet of
     Earth -> 1.0
     Mercury -> 0.2408467
     Venus -> 0.61519726
     Mars -> 1.8808158
     Jupiter -> 11.862615
     Saturn -> 29.447498
     Uranus -> 84.016846
     Neptune -> 164.79132
