import { render } from '@testing-library/react';
import { describe, it, expect } from 'vitest';
import GlobalLogicLogo from './GlobalLogicLogo';

describe('GlobalLogicLogo', () => {
  it('renders an inline SVG logo', () => {
    const { container } = render(<GlobalLogicLogo />);
    expect(container.querySelector('svg')).toBeInTheDocument();
  });

  it('uses default brand__logo className', () => {
    const { container } = render(<GlobalLogicLogo />);
    expect(container.querySelector('.brand__logo')).toBeInTheDocument();
  });

  it('forwards custom className to wrapper', () => {
    const { container } = render(<GlobalLogicLogo className="custom-logo" />);
    expect(container.querySelector('.custom-logo')).toBeInTheDocument();
  });
});
