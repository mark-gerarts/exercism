module SpaceAge (Planet(..), ageOn) where

data Planet = Mercury
            | Venus
            | Earth
            | Mars
            | Jupiter
            | Saturn
            | Uranus
            | Neptune

normalizeToEarthYear :: Float -> Float -> Float
normalizeToEarthYear ratio = (/ (ratio * 31557600))

ageOn :: Planet -> Float -> Float
ageOn Earth = normalizeToEarthYear 1.0
ageOn Mercury = normalizeToEarthYear 0.2408467
ageOn Venus = normalizeToEarthYear 0.61519726
ageOn Mars = normalizeToEarthYear 1.8808158
ageOn Jupiter = normalizeToEarthYear 11.862615
ageOn Saturn = normalizeToEarthYear 29.447498
ageOn Uranus = normalizeToEarthYear 84.016846
ageOn Neptune = normalizeToEarthYear 164.79132
