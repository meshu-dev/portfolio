import { useState } from '#imports'

export const setSiteData = (value: unknown): void => {
  useState('siteData').value = value
}
