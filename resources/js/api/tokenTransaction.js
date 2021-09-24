import Resource from '@/api/resource';

class TokenResource extends Resource {
  constructor() {
    super('tokens');
  }
}

export { TokenResource as default };
